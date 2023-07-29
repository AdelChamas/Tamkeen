<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function userPreferences(){
        return $this->belongsToMany(User::class, 'user_preferences', 'category_id', 'user_id');
    }

}
