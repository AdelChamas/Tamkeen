<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';

    protected $guarded = ['id'];

    public function chapters(){
        return $this->belongsTo(Course::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function discussions(){
        return $this->hasMany(Discussion::class);
    }

    public function assessments(){
        return $this->hasOne(Assessment::class);
    }
}
