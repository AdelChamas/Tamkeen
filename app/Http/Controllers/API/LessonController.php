<?php

namespace App\Http\Controllers\API;

use App\Models\Lesson;

class LessonController extends \App\Http\Controllers\Controller
{
    public function show($id){
        return Lesson::findOrFail($id);
    }
}
