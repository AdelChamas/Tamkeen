<?php

namespace App\Http\Controllers;

use App\Custom\GetStudentProgress;
use App\Http\Requests\NewDiscussionRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function show($course_id, $discussion_id){
        return view('student.course')->with([
            'discussion_' => Discussion::findOrFail($discussion_id),
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' => GetStudentProgress::getProgress($course_id)
        ]);
    }
    public function create(){
        return view('instructor.new_discussion')->with('chapters', Chapter::all());
    }

    public function store(NewDiscussionRequest $request){
        $request->validated();
        Discussion::create([
            'title' => $request->title,
            'question' => $request->question,
            'chapter_id' => $request->chapter
        ]);

        return redirect()->back()->with('success', 'Discussion Started!');
    }

    public function createDiscussion($chapter_id){
        return view('instructor.new_discussion')->with('chapter', Chapter::findOrFail($chapter_id));
    }

    public function storeDiscussion(NewDiscussionRequest $request, $chapter_id){
        $request->validated();
        Discussion::create([
            'title' => $request->title,
            'question' => $request->question,
            'chapter_id' => $chapter_id
        ]);

        return redirect()->back()->with('success', 'Discussion Started!');
    }

    public function edit($id){
        return view('instructor.discussion')->with('discussion', Discussion::findOrFail($id));
    }

    public function update(Request $request, $id){
        $discussion = Discussion::findOrFail($id);
        $discussion->title = $request->title;
        $discussion->question = $request->question;
        if($discussion->isDirty()){
            $discussion->save();
            return redirect()->back()->with('success', 'Discussion Updated Successfully.');
        }
        return redirect()->back()->with('info', 'Nothing to Update.');
    }

    public function destroy($id){
        Discussion::destroy($id);
        return redirect()->back()->with('sucess', 'Discussion Deleted Successfully.');
    }
}
