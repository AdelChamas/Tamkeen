<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

class AttachmentController extends Controller{
    public function index(){

    }


    public function show($lesson_id){
        return Lesson::findOrFail($lesson_id)->attachments;
    }
}
