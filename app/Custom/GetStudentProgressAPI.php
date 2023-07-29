<?php
namespace App\Custom;

use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Lesson;

trait GetStudentProgressAPI{
    public static function getStudentInvolvement($course_id){
        $involvements = 0;
        foreach (auth('api')->user()->coursesEnrolled as $course) {
            if ($course->id == $course_id) {
                $involvements += $course->classes->assessments_submitted + $course->classes->discussions_involved;
            }
        }

        return $involvements;
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
//        dd(array_unique($assessments));
        $total = sizeof($assessments) + sizeof(array_unique($discussions));
        return $total;
    }

    public static function setStatus($course_id){
        $course = Course::findOrFail($course_id);
        $assessments = [];
        $lessons = [];
        $discussions = [];
        $chapters = Chapter::where('course_id', $course_id)->get();


        foreach ($chapters as $chapter){
            array_push($assessments, Assessment::where('id', $chapter->assessment_id)->get());
            array_push($lessons, Lesson::where('chapter_id', $chapter->id)->get());
            array_push($discussions, Discussion::where('chapter_id', $chapter->id)->get());
        }

        foreach($lessons as $key){
            foreach ($key as $lesson) {
                array_push($assessments, Assessment::where('id', $lesson->quiz_id)->get());
            }
        }
        foreach (auth('api')->user()->coursesEnrolled as $course){
            if($course->id == $course_id){
                if($course->classes->certificate == 1){ // Issued
                    $course->classes->status = 1;
                    return;
                }else{
                    $total = static::getTotal($assessments, $discussions);
                    $completed = static::getStudentInvolvement($course_id);
                    if($total != 0){
                        $course->classes->status = $completed / $total;
                    }else{

                    }
                }
            }
        }

    }
    public static function getProgress($course_id){
        static::setStatus($course_id);
        foreach (auth('api')->user()->coursesEnrolled as $course){
            if($course->id == $course_id){
                return round($course->classes->status * 100, 2);
            }
        }
    }
}
