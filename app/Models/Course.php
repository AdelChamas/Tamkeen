<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "course";
    protected $guarded = ['id'];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function assesments(){
        return $this->hasMany(Assessment::class);
    }

    public function instructors(){
        return $this->belongsToMany(User::class, 'course_instructor', 'course_id', 'instructor_id');
    }

    public function students(){
        return $this->belongsToMany(User::class, 'student_enrolled', 'course_id', 'student_id')
            ->withTimestamps()
            ->withPivot(['status', 'certificate', 'assessments_submitted', 'discussions_involved']);
    }
}
