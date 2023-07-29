<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB'])->name('facebook');
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

Route::get('/lang/{lang}', function($lang){
    App::setLocale('ar');
    session(['language' => $lang]);
    session()->put('locale', $lang);
    return redirect()->back();
})->name('lang');

Route::get('/', function () {
    $topCategories = Category::select('category.*', DB::raw('count(course.id) as course_count'))
        ->leftJoin('course', 'category.id', '=', 'course.category_id')
        ->groupBy('category.id', 'category.category')
        ->orderByDesc('course_count')
        ->limit(6)
        ->get();
    return view('home')->with([
        'courses' => Course::limit(6)->get(),
        'categories' => $topCategories
    ]);
})->name('home');

Route::get('/search', function(){
    $searchText = request()->get('query');
    $results = DB::table('course')
        ->select('id', 'title', DB::raw("'course' as type"))
        ->where('title', 'LIKE', "%{$searchText}%")
        ->orWhere(function ($query) use ($searchText) {
            $query->from('chapter')
                ->select('id', 'title', DB::raw("'chapter' as type"))
                ->where('title', 'LIKE', "%{$searchText}%");
        })
        ->orWhere(function ($query) use ($searchText) {
            $query->from('lesson')
                ->select('id', 'title', DB::raw("'lesson' as type"))
                ->where('title', 'LIKE', "%{$searchText}%");
        })
        ->orWhere(function ($query) use ($searchText) {
            $query->from('discussion')
                ->select('id', 'title', DB::raw("'discussion' as type"))
                ->where('title', 'LIKE', "%{$searchText}%");
        })
        ->get();
    $search_results = [];
    foreach($results as $result){
        array_push($search_results, Course::find($result->id));
    }
    return view('courses')->with('courses', $search_results);
})->name('search');

Route::prefix('/student')->middleware(['auth', 'verified'])->group(function (){
    Route::get('/', [UserController::class, 'studentDashboard'])->name('studentDashboard');
    Route::get('/dashboard', [UserController::class, 'studentDashboard'])->name('studentDashboard');

    Route::get('courses/enroll/{course_id}', [CourseController::class, 'enroll'])->name('enroll');

    Route::get('preferences', [UserController::class, 'editPreferences'])->name('editPreferences');
    Route::post('preferences/set', [UserController::class, 'setPreferences'])->name('setPreferences');


    Route::get('/suggested', function(){
        $courses = [];
        foreach(auth()->user()->preferences as $preference){
            array_push($courses, Course::where('category_id', $preference->id)->get());
        }
        return view('courses')->with('courses', $courses);
    })->name('forYou');

    Route::get('/course/{id}', [CourseController::class, 'studentShow'])->name('studyCourse');
    Route::get('/course/lesson/{course_id}/{lesson_id}', [LessonController::class, 'studentShow'])->name('studyLesson');

    Route::get('/course/chapter/discussion/{course_id}/{discussion_id}', [DiscussionController::class, 'show'])->name('chapterDiscussion');


    Route::post('/course/chapter/discussion/{discussion_id}/new-message', [MessageController::class, 'store'])->name('newMessage');


    Route::get('/course/chapter/lesson/quiz/{course_id}/{quiz_id}', [AssessmentController::class, 'showQuiz'])->name('lessonQuiz');
    Route::post('/course/chapter/lesson/asses/quiz/{course_id}/{quiz_id}', [AssessmentController::class, 'assessQuiz'])->name('assessQuiz');

    Route::get('/course/chapter/exam/{course_id}/{exam_id}', [AssessmentController::class, 'show'])->name('chapterExam');
    Route::post('/course/chapter/asses/exam/{course_id}/{exam_id}', [AssessmentController::class, 'assess'])->name('assess');

    Route::get('/course/chapter/note/{course_id}/{note_id}', [NoteController::class, 'show'])->name('chapterNote');

    Route::get('/certificate/issue/{course_id}', [CourseController::class, 'certificate'])->name('certificate');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses');


Route::get('/register/instructor', function(){
    return view('student.register_instructor');
})->name('register_instructor');

Route::post('/register/instructor', [UserController::class, 'instructor'])->name('registerInstructor');

Route::prefix('/instructor')->middleware(['auth', 'verified'])->group(function (){
    Route::get('/', [UserController::class, 'instructorIndex'])->name('instructorDashboard');
    Route::get('/dashboard', [UserController::class, 'instructorIndex'])->name('instructorDashboard');


    Route::get('/new-chapter', [ChapterController::class, 'create'])->name('newChapterNoCourse');
    Route::post('/new-chapter', [ChapterController::class, 'store'])->name('newChapterNoCourse');
    Route::get('/new-chapter/{course_id}', [ChapterController::class, 'createChapter'])->name('newChapter');
    Route::post('/new-chapter/{course_id}', [ChapterController::class, 'storeChapter'])->name('newChapter');
    Route::get('/chapters/{course_id}', [ChapterController::class, 'instructorIndex'])->name('instructorChapters');
    Route::get('/update-chapter/{id}', [ChapterController::class, 'instructorShow'])->name('updateChapter');
    Route::post('/update-chapter/{id}', [ChapterController::class, 'update'])->name('updateChapter');
    Route::delete('/delete-chapter/{id}', [ChapterController::class, 'destroy'])->name('deleteChapter');


    Route::get('/new-note/{chapter_id}', [NoteController::class, 'create'])->name('newNote');
    Route::post('/new-note/{chapter_id}', [NoteController::class, 'store'])->name('newNote');
    Route::get('/update-note/{id}', [NoteController::class, 'edit'])->name('updateNote');
    Route::post('/update-note/{id}', [NoteController::class, 'update'])->name('updateNote');
    Route::delete('/delete-note/{id}', [NoteController::class, 'destroy'])->name('deleteNote');

    Route::get('/new-course', [CourseController::class, 'create'])->name('newCourse');
    Route::post('/new-course', [CourseController::class, 'store'])->name('newCourse');
    Route::get('/update-course/{id}', [CourseController::class, 'edit'])->name('updateCourse');
    Route::post('/update-course/{id}', [CourseController::class, 'update'])->name('updateCourse');
    Route::delete('/delete-course/{id}', [CourseController::class, 'destroy'])->name('deleteCourse');
    Route::get('/course/{id}', [CourseController::class, 'instructorShow'])->name('instructorCourse');



    Route::get('/new-lesson', [LessonController::class, 'create'])->name('newLessonNoChapter');
    Route::post('/new-lesson', [LessonController::class, 'store'])->name('newLessonNoChapter');
    Route::get('/new-lesson/{chapter_id}', [LessonController::class, 'createLesson'])->name('newLesson');
    Route::post('/new-lesson/{chapter_id}', [LessonController::class, 'storeLesson'])->name('newLesson');
    Route::get('/edit-lesson/{id}', [LessonController::class, 'edit'])->name('updateLesson');
    Route::post('/edit-lesson/{id}', [LessonController::class, 'update'])->name('updateLesson');
    Route::delete('/delete-lesson/{id}', [LessonController::class, 'delete'])->name('deleteLesson');


    Route::get('/new-assessment/{course_id?}', [AssessmentController::class, 'create'])->name('newAssessment');
    Route::post('/new-assessment/{course_id?}', [AssessmentController::class, 'store'])->name('newAssessment');


    Route::get('/add-instructor/{course_id}', [CourseController::class, 'addInstructor'])->name('addInstructor');
    Route::post('/add-instructor/{course_id}', [CourseController::class, 'storeInstructor'])->name('addInstructor');
    Route::get('/remove-instructor/{course_id}/{instructor_id}', [CourseController::class, 'removeInstructor'])->name('removeInstructor');
    
    // Social Learning
    Route::get('/new-discussion', [DiscussionController::class, 'create'])->name('newDiscussionNoChapter');
    Route::post('/new-discussion', [DiscussionController::class, 'store'])->name('newDiscussionNoChapter');
    Route::get('/new-discussion/{chapter_id}', [DiscussionController::class, 'createDiscussion'])->name('newDiscussion');
    Route::post('/new-discussion/{chapter_id}', [DiscussionController::class, 'storeDiscussion'])->name('newDiscussion');
    Route::get('/update-discussion/{id}', [DiscussionController::class, 'edit'])->name('updateDiscussion');
    Route::post('/update-discussion/{id}', [DiscussionController::class, 'update'])->name('updateDiscussion');
    Route::delete('/delete-discussion/{id}', [DiscussionController::class, 'destroy'])->name('deleteDiscussion');

});



Route::get('courses/course/{id}', [CourseController::class, 'show'])->name('course');
Route::get('courses/{category_id}', [CourseController::class, 'showByCategory'])->name('courseCategory');


require __DIR__.'/auth.php';
