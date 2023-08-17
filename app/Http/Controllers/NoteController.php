<?php

namespace App\Http\Controllers;

use App\Custom\GetStudentProgress;
use App\Http\Requests\NewNoteRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function show($course_id, $note_id){
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id),
            'note_' => Note::findOrFail($note_id)
        ]);
    }


    public function create($chapter_id){
        return view('instructor.new_note')->with('chapter', Chapter::findOrFail($chapter_id));
    }

    
    public function createNoChapter(){
        return view('instructor.new_note')->with('chapters', Chapter::all());
    }

    public function store(NewNoteRequest $request, $chapter_id){
        $request->validated();
        $chapter = Chapter::findOrFail($chapter_id);
        $note = Note::create([
            'title' => $request->title,
            'note' => clean($request->note),
            'user_id' => auth()->id()
        ]);
        $chapter->note_id = $note->id;
        $chapter->save();

        return redirect()->back()->with('success', __('success.note_inserted'));
    }

    public function storeNoChapter(NewNoteRequest $request){
        $request->validated();
        $chapter = Chapter::findOrFail($request->chapter);
        $note = Note::create([
            'title' => $request->title,
            'note' => clean($request->note),
            'user_id' => auth()->id()
        ]);
        $chapter->note_id = $note->id;
        $chapter->save();

        return redirect()->back()->with('success', __('success.note_inserted'));
    }


    public function edit($id){
        return view('instructor.note')->with('note', Note::findOrFail($id));
    }

    public function update(NewNoteRequest $request, $id){
        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->note = $request->note;

        if($note->isDirty()){
            $note->save();
            return redirect()->back()->with('success', __('success.note_updated'));
        }

        return redirect()->back()->with('info', __('info.nothing_update'));
    }

    public function destroy($id){
        Note::destroy($id);
        return redirect()->back()->with('success', __('success.note_deleted'));
    }
}
