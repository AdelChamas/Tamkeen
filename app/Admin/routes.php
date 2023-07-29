<?php

use App\Admin\Controllers\AssesmentController;
use App\Admin\Controllers\AttachementController;
use App\Admin\Controllers\ChapterController;
use App\Admin\Controllers\CourseController;
use App\Admin\Controllers\DiscussionController;
use App\Admin\Controllers\LessonController;
use App\Admin\Controllers\MessageController;
use App\Admin\Controllers\NoteController;
use App\Admin\Controllers\SocialMediaController;
use Encore\Admin\Controllers\UserController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('courses', CourseController::class);
    $router->resource('chapters', ChapterController::class);
    $router->resource('assesments', AssesmentController::class);
    $router->resource('attachments', AttachementController::class);
    $router->resource('discussion', DiscussionController::class);
    $router->resource('lessons', LessonController::class);
    $router->resource('messages', MessageController::class);
    $router->resource('notes', NoteController::class);
    $router->resource('social-medias', SocialMediaController::class);
    $router->resource('users', UserController::class);
    $router->resource('categories', CategoryController::class);
});
