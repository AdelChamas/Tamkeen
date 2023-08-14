<?php

use App\Http\Controllers\API\AssessmentController;
use App\Http\Controllers\API\AttachmentController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\DiscussionController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\AuthController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('search', function(){
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
    return $search_results;
});

Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('account/{id}', [UserController::class, 'show']);
    Route::get('preferences', [UserController::class, 'preferences']);
    Route::get('student/course/{course_id}/progress', [CourseController::class, 'studentProgress']);
    Route::get('chapters/{course_id}', [ChapterController::class, 'show']);
    Route::get('discussion/{chapter_id}', [DiscussionController::class, 'show']);


    Route::get('account', [UserController::class, 'index']);
    Route::post('account/update', [UserController::class, 'update']);

    Route::get('get-preferences', [UserController::class, 'getPreferences']);
    Route::post('set-preferences', [UserController::class, 'setPreferences']);

    Route::get('student/dashboard', [UserController::class, 'studentDashboard']);
    Route::get('course/main/{course_id}', [CourseController::class, 'studentShow']);
    Route::get('course/main/lesson/{id}', [LessonController::class, 'show']);
    Route::get('course/main/lesson/attachments/{lesson_id}', [AttachmentController::class, 'show']);
    Route::get('courses/enrolled', [CourseController::class, 'enrolled']);
    Route::post('courses/enroll', [CourseController::class, 'enroll']);
    Route::get('courses/suggested', [CourseController::class, 'suggested']);

    Route::get('instructor/dashboard', [UserController::class, 'instructorDashboard']);

    Route::get('suggested', function(){
        $courses = [];
        foreach(auth('api')->user()->preferences as $preference){
            array_push($courses, Course::where('category_id', $preference->id)->get());
        }
        return $courses;
    });
});

Route::get('assessments', [AssessmentController::class, 'index'])->name('assessments');

Route::get('courses', [CourseController::class, 'index']);
## Error

//Route::get('attachments', [AttachmentController::class, 'index'])->name('attachments');
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('course_instructor');
Route::get('lessons/{course_id}', [DiscussionController::class, 'show'])->name('lessons');
Route::get('message');
Route::get('note');
Route::get('social_media');
Route::get('student_enrolled');
Route::get('student_exam');
Route::get('user');
