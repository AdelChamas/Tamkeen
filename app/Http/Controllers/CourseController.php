<?php

namespace App\Http\Controllers;

use App\Custom\Certificate;
use App\Http\Requests\NewCourseRequest;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Custom\GetStudentProgress;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Collection;

class CourseController extends Controller
{
    /**
     * Display all the courses
     */
    public function index(){
        return view('courses')->with('courses', Course::all());
    }

    /**
     * display the specified course
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id){
        return view('course')->with('course', Course::findOrFail($id));
    }

    public function showByCategory($category_id){
        return view('courses')->with([
            'courses' => Course::where('category_id', $category_id)->get(),
            'category' => Category::findOrFail($category_id)
        ]);
    }


    public function enroll($course_id){
        if(! auth()->user()->coursesEnrolled()->where('course_id', $course_id)->exists()){
            auth()->user()->coursesEnrolled()->attach(Course::findOrFail($course_id),
                [
                    'status' => 0,
                    'certificate' => 0,
                    'assessments_submitted' => 0,
                    'discussions_involved' => 0
                ]
            );
            $chapters = Chapter::where('course_id', $course_id)->get();
            $exams = [];
            foreach ($chapters as $chapter){
                array_push($exams, Assessment::where('id', $chapter->assessment_id)->get());
            }
            foreach($exams as $exam){
                auth()->user()->exams()->attach($exam, ['status' => 0]);
            }
            return redirect(route('studyCourse', ['id' => $course_id]));
        }
        return redirect(route('studyCourse', ['id' => $course_id]));
    }



    public function create(){
        return view('instructor.new_course')->with('categories', Category::all());
    }

    public function store(NewCourseRequest $request){
        $request->validated();

        $img = Storage::disk('public')->put('/courses', $request->image);

        $overview = clean($request->overview);
        $outcomes = clean($request->outcomes);
        $about = clean($request->about);

        $course = Course::create([
            'title' => $request->title,
            'price' => $request->price,
            'overview' => $overview,
            'subjects' => $request->subjects,
            'outcomes' => $outcomes,
            'pre_requisites' => $request->pre,
            'about'=> $about,
            'simplicity_level' => $request->simplicity_level,
            'image' => $img,
            'category_id' => $request->category
        ]);

        $course->instructors()->attach(auth()->user(), ['main' => 1]);

        return redirect()->back()->with('success', __('success.course_created'));
    }


    public function instructorShow($course_id){
        return view('instructor.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'categories' => Category::all()
        ]);
    }


    public function studentShow($course_id){
        return view('student.course')->with([
            'course' => Course::findOrFail($course_id),
            'chapters' => Chapter::where('course_id', $course_id)->get(),
            'progress' =>  GetStudentProgress::getProgress($course_id)
        ]);
    }


    public function edit($id){
        return view('instructor.course')->with([
            'course' => Course::findOrFail($id),
            'categories' => Category::all()]);
    }

    public function update(NewCourseRequest $request, $id){
        $request->validated();
        $course = Course::findOrFail($id);

        $newImage = $_FILES['image']['tmp_name'];
        $oldImage = asset('storage/' . $course->image);
        $newImageHash = hash_file('md5', $newImage);
        $oldImageHash = hash_file('md5', $oldImage);

        $img = Storage::disk('public')->put('/courses', $request->image);

        $overview = clean($request->overview);
        $outcomes = clean($request->outcomes);
        $about = clean($request->about);

        $course->title = $request->title;
        $course->price = $request->price;
        $course->overview = $overview;
        $course->subjects = $request->subjects;
        $course->outcomes = $outcomes;
        $course->pre_requisites = $request->pre;
        $course->about = $about;
        $course->simplicity_level = $request->simplicity_level;
        if($newImageHash !== $oldImageHash){
            $course->image = $img;
        }
        $course->category_id = $request->category;

        if($course->isDirty()){
            $course->save('success', __('success.course_updated'));
        }
        return redirect()->back()->with('info', __('info.nothing_update'));
    }
    
    /**
     * Delete the course and its video, poster, and attachments.
     *   
     */
    public function destroy($id){
        $course = Course::findOrFail($id);
        // attachment/video -> lesson -> chapter -> course
        $chapters = $course->chapters;
        $lessons = [];
        foreach($chapters as $chapter){
            $lessons[] = $chapter->lessons;
        }
        $files = [];
        foreach($lessons as $lesson){
            foreach($lesson as $l){
                $files[] = $l->attachments;
                $files[] = $l->poster;
                $files[] = $l->video;
            }
        }
        $files[] = $course->image;
        foreach($files as $file){
            if($file instanceof Collection){
                foreach($file as $f){
                    Storage::disk('public')->delete($f->attachment);
                }
            }else{
                Storage::disk('public')->delete($file);
            }
        }
        Course::destroy($id);
        return redirect()->back()->with('success', __('success.course_deleted'));
    }



    public function certificate($course_id){
        $chapters = Chapter::where('course_id', $course_id)->get();
        $course_assessments = [];
        foreach($chapters as $chapter){
            $course_assessments[] = Assessment::where('id', $chapter->assessment_id)->first();
        }
        foreach($course_assessments as $assessment) {
            if ($assessment->type == 2) { // Exam
                if (auth()->user()->exams()->wherePivot('exam_id', $assessment->id)->value('status') == 0) {
                    return redirect()->back()->with('certificate_locked', __('info.certificate_locked'));
                }
            }
        }

        if(sizeof($course_assessments) > 0){
            return Certificate::generate($course_id);
        }

        return redirect()->back()->with('certificate_locked', __('info.no_certificate'));
    }

    public function addInstructor($course_id){
        $course_instructors = User::whereHas('coursesTaught', function ($query) {
            $query->where('main', 0);
        })->get();
        return view('instructor.new_instructor')->with([
            'instructors' => User::where('role', '2')->get(),
            'course_id' => $course_id,
            'course_instructors' => $course_instructors ]);
    }

    public function storeInstructor(Request $request, $course_id){
        $course = Course::findOrFail($course_id);
        if($course->instructors()->where('instructor_id', $request->instructor)->exists()){
            return redirect()->back()->with('info', __('info.instructor_exists'));
        }
        $course->instructors()->attach(User::where('id', $request->instructor)->first());
        return redirect()->back()->with('success', __('success.instructor_added'));
    }

    public function removeInstructor($course_id, $instructor_id){
        $course = Course::findOrFail($course_id);
        $course->instructors()->detach(User::where('id', $instructor_id)->first());
        return redirect()->back()->with('success', __('success.instructor_removed'));
    }


    public function instructor($instructor_id){
        $instructor = User::with('coursesTaught')->find($instructor_id);
        $courses = $instructor->coursesTaught;
        return view('courses')->with([
            'courses' => $courses,
            'instructor' => $instructor
        ]);
    }
}
