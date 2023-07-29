<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewChapterRequest;
use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Lesson;
use App\Models\Note;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Create new chapter
     * [The course is determined by a <select>]
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('instructor.new_chapter')->with([
            'courses' => Course::all(),
            'assessments' => Assessment::all(),
            'notes' => Note::all(),
        ]);
    }
    /**
     * Create new chapter for the given course
     *
     * @param $course_id
     */
    public function createChapter($course_id){
       return view('instructor.new_chapter')->with([
            'course' => Course::findOrFail($course_id),
            'assessments' => Assessment::all(),
            'notes' => Note::all(),

       ]);
    }


    /**
     * Store new chapter inside db
     * [The course is determined by a <select>]
     */
    public function store(NewChapterRequest $request){
        $request->validated();
        Chapter::create([
            'title' => $request->title,
            'assessment_id' => ($request->assessment) ?? NULL,
            'note_id' => ($request->note) ?? NULL,
            'course_id' => null
        ]);
        if(isset($request->assessment)){
            $course = Course::find($request->course);
            $chapters = Chapter::where('course_id', $request->course)->get();
            $students = $course->students;
            $exams = [];
            foreach ($chapters as $chapter){
                array_push($exams, Assessment::where('id', $chapter->assessment_id)->get());
            }
            foreach($exams as $exam){
                foreach($students as $student){
                    $student->exams()->attach($exam, ['status' => 0]);
                }
            }
        }
        return redirect()->back()->with('success', 'Chapter Created Successfully.');
    }

    /**
     * @param NewChapterRequest $request
     * @param $course_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeChapter(NewChapterRequest $request, $course_id){
        $request->validated();
        Chapter::create([
            'title' => $request->title,
            'assessment_id' => ($request->assessment) ?? NULL,
            'note_id' => ($request->note) ?? NULL,
            'course_id' => $course_id
        ]);
        return redirect()->back()->with('success', 'Chapter Created Successfully.');
    }

    public function instructorIndex($course_id){
        $chapters = Chapter::where('course_id', $course_id)->get();
        return view('instructor.chapters')->with('chapters', $chapters);
    }

    public function instructorShow($id){
        $chapter = Chapter::findOrFail($id);
        return view('instructor.chapter')->with([
            'chapter' => $chapter,
            'assessments' => Assessment::where('user_id', auth()->id())->get(),
            'notes' => Note::where('user_id', auth()->id())->get(),
            'lessons' => Lesson::where('chapter_id', $id)->get(),
            'discussions' => Discussion::where('chapter_id', $id)->get()
        ]);
    }


    public function update(NewChapterRequest $request, $id){
        $request->validated();
        $chapter = Chapter::findOrFail($id);
        $chapter->title = $request->title;
        $chapter->assessment_id = $request->assessment;
        $chapter->note_id = $request->note;
        if($chapter->isDirty()){
            $chapter->save();
            return redirect()->back()->with('success', 'Chapter Updated Successfully.');
        }

        return redirect()->back()->with('info', 'Nothing to Update.');
    }

    public function destroy($id){
        Chapter::destroy($id);
        return redirect()->back()->with('success', 'Chapter Deleted Successfully');
    }
}
