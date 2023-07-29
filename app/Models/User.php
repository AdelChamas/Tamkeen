<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function coursesEnrolled(){
        return $this->belongsToMany(Course::class, 'student_enrolled', 'student_id', 'course_id')
            ->withTimestamps()
            ->withPivot(['status', 'certificate', 'assessments_submitted', 'discussions_involved'])
            ->as('classes');
    }

    public function assessmentsAdded(){
        return $this->hasMany(Assessment::class);
    }

    public function coursesTaught(){
        return $this->belongsToMany(Course::class, 'course_instructor', 'instructor_id', 'course_id');
    }

    public function messagesSent(){
        return $this->hasMany(Message::class);
    }

    public function messsagesReceived(){
        return $this->hasMany(Message::class);
    }


    public function exams(){
        return $this->belongsToMany(Assessment::class, 'student_exam', 'student_id', 'exam_id')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function preferences(){
        return $this->belongsToMany(Category::class, 'user_preferences', 'user_id', 'category_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
