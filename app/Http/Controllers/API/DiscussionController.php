<?php

namespace App\Http\Controllers\API;
use App\Models\Discussion;

class DiscussionController extends \App\Http\Controllers\Controller{
    public function show($chapter_id){
        return Discussion::where('chapter_id', $chapter_id)->get();
    }
}
