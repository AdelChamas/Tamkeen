<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;

class ChapterController extends Controller{
    public function index(){

    }

    public function show($course_id){
        return Chapter::where('course_id', $course_id)->get();
    }
}
