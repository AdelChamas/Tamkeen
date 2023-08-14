<?php

namespace App\Http\Controllers;

use App\Custom\GetStudentProgress;
use App\Http\Requests\NewAssessmentRequest;
use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function create(){
        return view('instructor.new_assessment');
    }

    public function store(NewAssessmentRequest $request, ...$course_id){
        $request->validated();
        Assessment::create([
            'title' => $request->title,
            'structure' => $request->structure,
            'duration' => $request->duration,
            'type' => $request->type,
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', __('success.assessment_inserted'));
    }

    public function show($course_id, $exam_id){
        $user_exams = auth()->user()->exams;
        foreach ($user_exams as $exam){
            if($exam->id == $exam_id && auth()->user()->exams()->wherePivot('exam_id', $exam_id)->value('status') == 1){
                return redirect()->back()->with('info', __('info.exam_submitted'));
            }
        }
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id),
            'exam' => Assessment::findOrFail($exam_id)
        ]);
    }

    public function showQuiz($course_id, $quiz_id){
        $user_exams = auth()->user()->exams;
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id),
            'quiz' => Assessment::findOrFail($quiz_id)
        ]);
    }

    public function assess(Request $request, $course_id, $exam_id){
        if(auth()->user()->exams()->wherePivot('exam_id', $exam_id)->value('status') == 1){
            return redirect()->back()->with('info', __('info.exam_submitted'));
        }
        auth()->user()->coursesEnrolled()->updateExistingPivot(Course::find($course_id), ['assessments_submitted' => DB::raw('assessments_submitted + 1')]);
        auth()->user()->exams()->attach($exam_id);
        auth()->user()->exams()->updateExistingPivot($exam_id, ['status' => 1]);
        if(sizeof($request->all()) <= 2){
            return redirect()->back()->with('info', __('info.zero'));
        }

        $barem = [];
        $result = 0;
        $exam = Assessment::findOrFail($exam_id);
        $structure = json_decode($exam->structure, true);
        foreach ($structure as $_question) {
            $barem[$_question['Question']] = $_question['Correct'];
            $grades[$_question['Question'] . 'grade'] = $_question['Grade'];
        }
        foreach (explode(',', $request->get('questions')) as $question) {
            if(sizeof($barem[$question]) == 1){
                $quest = str_replace(' ', '_', $question);
                if(!is_null($request->get($quest)) && ((int) ($request->get($quest) + 1) ) == $barem[$question][0]){
                    $result += $grades[str_replace('_', ' ', $quest) . 'grade'];
                }
            }
        }
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id),
            'result' => $result,
        ]);
    }

    public function assessQuiz(Request $request, $course_id, $quiz_id){
        if(sizeof($request->all()) <= 2){
            return redirect()->back()->with('info', __('info.zero'));
        }

        $barem = [];
        $result = 0;
        $exam = Assessment::findOrFail($quiz_id);
        $structure = json_decode($exam->structure, true);
        foreach ($structure as $_question) {
            $barem[$_question['Question']] = $_question['Correct'];
            $grades[$_question['Question'] . 'grade'] = $_question['Grade'];
        }
        foreach (explode(',', $request->get('questions')) as $question) {
            if(sizeof($barem[$question]) == 1){
                $quest = str_replace(' ', '_', $question);
                if(!is_null($request->get($quest)) && ((int) ($request->get($quest) + 1) ) == $barem[$question][0]){
                    $result += $grades[str_replace('_', ' ', $quest) . 'grade'];
                }
            }
        }
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id),
            'result' => $result,
        ]);
    }

}
