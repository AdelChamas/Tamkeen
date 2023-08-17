<?php
namespace App\Custom;

use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Lesson;


use Illuminate\Support\Collection;

/**
 * Student Progress
 * percentage shown: 10% discussions, 90% exams
 */
trait GetStudentProgress{
    public static function getNbMessagesSent($course_id){
        foreach (auth()->user()->coursesEnrolled as $course) {
            if ($course->id == $course_id) {
                return $course->classes->discussions_involved;
            }
        }
    }

    public static function getSubmittedExams($course_id){
        foreach (auth()->user()->coursesEnrolled as $course) {
            if ($course->id == $course_id) {
                return $course->classes->assessments_submitted;
            }
        }
    }

    public static function getTotal($assessments, $discussions){
        $total = 0;

        // clean assessments array from empty values
        foreach ($assessments as $assessment) {
            if($assessment->count() == 0){ // delete
                $key = array_search($assessment, $assessments);
                if ($key !== false) {
                    unset($assessments[$key]);
                }
            }
        }


        // clean discussion array from empty values
        foreach ($discussions as $discussion) {
            if($discussion->count() == 0){ // delete
                $key = array_search($discussion, $discussions);
                if ($key !== false) {
                    unset($discussions[$key]);
                }
            }
        }
//        same exam for mutliple lessons/chapters
        $assessments_ = new Collection($assessments);
        $total = sizeof($assessments_->unique('id')) + sizeof(array_unique($discussions));
        return $total;
    }

    public static function getTotalExams($assessments){
        foreach ($assessments as $assessment) {
            if(is_null($assessment)){
                continue;
            }
            if($assessment->count() == 0){ // delete
                $key = array_search($assessment, $assessments);
                if ($key !== false) {
                    unset($assessments[$key]);
                }
            }
        }
        return sizeof(array_unique($assessments));
    }

    public static function getTotalDiscussions($discussions){
        foreach ($discussions as $discussion) {
            if($discussion->count() == 0){ // delete
                $key = array_search($discussion, $discussions);
                if ($key !== false) {
                    unset($discussions[$key]);
                }
            }
        }
        $d = new Collection($discussions);
        return sizeof($d->unique('id'));
    }

    public static function setStatus($course_id){
        $course = Course::findOrFail($course_id);
        $assessments = [];
        $lessons = [];
        $discussions = [];
        $chapters = Chapter::where('course_id', $course_id)->get();


        /**
         * Get lessons, chapters, discusssions of the course
         */
        foreach ($chapters as $chapter){
            array_push($assessments, Assessment::where('id', $chapter->assessment_id)->first());
            array_push($lessons, Lesson::where('chapter_id', $chapter->id)->get());
            array_push($discussions, Discussion::where('chapter_id', $chapter->id)->get());
        }

        // Group assessments for each lesson
        foreach($lessons as $key){
            foreach ($key as $lesson) {
                array_push($assessments, Assessment::where('id', $lesson->quiz_id)->first());
            }
        }


        foreach (auth()->user()->coursesEnrolled as $course){
            if($course->id == $course_id){
                if($course->classes->certificate == 1){ // Issued
                    $course->classes->status = 1;
                    return;
                }else{
                    $exams = static::getTotalExams($assessments);
                    $submitted_exams = static::getSubmittedExams($course_id);
                    if($submitted_exams >= $exams){
                        $course->classes->status = 1;
                    }else{
                        $discussions_ = static::getTotalDiscussions($discussions);
                        $messages_sent = static::getNbMessagesSent($course_id);
                        if($discussions_ > 0){
                            $involv = $messages_sent / $discussions_;
                            if($involv > 10){
                                $involv = 10;
                            }
                            $total = (($submitted_exams / $exams) * 100) + $involv;
                            $course->classes->status = $total;
                        }
                        
                    }
                    
                }
            }
        }

    }
    public static function getProgress($course_id){
        static::setStatus($course_id);
        foreach (auth()->user()->coursesEnrolled as $course){
            if($course->id == $course_id){
                return round($course->classes->status, 2);
            }
        }
    }
}
