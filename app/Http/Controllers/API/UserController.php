<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function index(){
        return auth('api')->user();
    }

    public function preferences(){
        return auth('api')->user()->preferences;
    }

    public function studentDashboard(){
        return Course::whereHas('students', function($query){
            $query->where('student_id', auth('api')->id());
        })->get();
    }

    public function instructorDashboard(){
        return Course::whereHas('instructors', function ($query){
                $query->where('instructor_id', auth('api')->id());
            })->get();
    }


    public function update(Request $request){
        $user = auth('api')->user();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        if($user->isDirty()){
            $user->save();
            return response('Profile Updated Successfully');
        }else{
            return response('Nothing to Update');
        }
    }
}
