<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLessonRequest;
use App\Models\Assessment;
use App\Models\Attachment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Custom\GetStudentProgress;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{

    public function create(){
        return view('instructor.new_lesson')->with([
            'chapters' => Chapter::all(),
            'assessments' => Assessment::all()
        ]);
    }

    public function storeLesson(NewLessonRequest $request, $chapter_id)
    {
        $data = $request->validated();
        $video = null;
        if ($request->hasFile('video')) {
            $video = Storage::disk('public')->put('/courses/lessons', $request->file('video'));
        }

        if($request->hasFile('poster')){
            $poster = Storage::disk('public')->put('/courses/lessons/posters', $request->file('poster'));
        }

        $attachments = [];
        if ($request->hasFile('attachment')) {
            if(sizeof($request->file('attachment')) > 1){
                foreach ($request->file('attachment') as $file) {
                    $attach = Storage::disk('public')->put('/courses/lessons/attachments/', $file);
                    array_push($attachments, $attach);
                }
            }else{
                $attach = Storage::disk('public')->put('/courses/lessons/attachments/', $request->file('attachment')[0]);
                Attachment::create([
                    'attachment' => $attach
                ]);
            }

        }

        $lesson = Lesson::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'video' => $video,
            'poster' => ($poster) ?? null,
            'chapter_id' => $chapter_id,
            'quiz_id' => $data['quiz'],
        ]);

        if (!empty($attachments)) {
            foreach ($attachments as $attachment){
                $_attach = Attachment::create([
                    'attachment' => $attachment
                ]);
                $lesson->attachments()->attach($_attach);
            }
        }

        return redirect()->back()->with('success', __('success.lesson_insert'));
    }


    public function createLesson($chapter_id){
        return view('instructor.new_lesson')->with([
            'chapter' => Chapter::findOrFail($chapter_id),
            'assessments' => Assessment::all()
        ]);
    }

    public function store(NewLessonRequest $request){
        $request->validate([
            'chapter' => 'required',
        ]);
        $request->validated();

        $video = null;
        if ($request->hasFile('video')) {
            $video = Storage::disk('public')->put('/courses/lessons', $request->file('video'));
        }

        $attachments = [];
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $attach = Storage::disk('public')->put('/courses/lessons/attachments/', $file);
                array_push($attachments, $attach);
            }
        }

        if($request->hasFile('poster')){
            $poster = Storage::disk('public')->put('/courses/lessons/posters', $request->file('poster'));
        }

        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $video,
            'poster' => ($poster) ?? NULL,
            'chapter_id' => ($request->chapter) ?? NULL,
            'quiz_id' => $request->quiz,
        ]);

        if (!empty($attachments)) {
            $ids = [];
            foreach($attachments as $attachment){
                $attach = Attachment::create([
                    'attachment' => $attachment
                ]);
                array_push($ids, $attach->id);
            }
            foreach($ids as $id){
                $lesson->attachments()->attach(Attachment::find($id));
            }
        }

        return redirect()->back()->with('success', __('success.lesson_insert'));
    }


    public function edit($id){
        return view('instructor.lesson')->with([
            'lesson' => Lesson::findOrFail($id),
            'assessments' => Assessment::all()
        ]);
    }

    public function update(NewLessonRequest $request, $id){
        $request->validated();
        $lesson = Lesson::findOrFail($id);

        if($request->hasFile('video')){
            $video = Storage::disk('public')->put('/courses/lessons', $request->video);
        }
        if($request->hasFile('attachment')){
            $attach = Storage::disk('public')->put('/courses/lessons/attachments/', $request->attachment);
            $attachment = Attachment::create([
                'attachment' => $attach
            ]);
        }

        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->video = ($video) ?? $lesson->video;
        $lesson->attachment_id = ($attachment->id) ?? $lesson->attachment_id;
        $lesson->quiz_id = $lesson->quiz;

        if($lesson->isDirty()){
            $lesson->save();
            return redirect()->back()->with('success', __('success.lesson_update'));
        }else{
            return redirect()->back()->with('info', __('info.nothing_to_update'));
        }
    }


    public function studentShow($course_id, $lesson_id){
        return view('student.course')->with([
            'lesson_' => Lesson::findOrFail($lesson_id),
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' => GetStudentProgress::getProgress($course_id)
        ]);
    }

    public function destroy($id){
        Lesson::destroy($id);
        return redirect()->back()->with('success', 'Lesson Deleted Successfully.');
    }
}
