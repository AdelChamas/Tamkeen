<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assesment';
    protected $guarded = ['id'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class);
    }

    public function chapters(){
        return $this->belongsTo(Chapter::class);
    }

    public function studentExams(){
        return $this->belongsToMany(User::class, 'student_exam', 'exam_id', 'student_id')#
        ->withTimestamps()
        ->withPivot('status');
    }
}
