<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachment';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function lessonAttachment(){
        return $this->belongsToMany(Lesson::class, 'lesson_attachment', 'attachment_id', 'lesson_id');
    }
}
