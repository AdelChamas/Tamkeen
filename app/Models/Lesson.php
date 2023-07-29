<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';
    protected $guarded = ['id'];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function attachments(){
        return $this->belongsToMany(Attachment::class, 'lesson_attachment', 'lesson_id', 'attachment_id');
    }
}
