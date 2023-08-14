<?php

namespace App\Custom;

use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;

trait Certificate{
    public static function isCompleted($course){
        $progress = auth()->user()->coursesEnrolled()->wherePivot('course_id', $course)->first();
        if($progress->status < 100){
            return false;
        }
    }

    public static function generate($course){
        if(! static::isCompleted($course)){
            return redirect()->back()->with('info', __('info.certificate_locked'));
        }else{
            $studentName = auth()->user()->full_name;
            $courseName = Course::findOrFail($course)->title;
            $pdf = PDF::loadView('certificate', compact('studentName', 'courseName'));
            auth()->user()->coursesEnrolled()->updateExistingPivot($course, ['certificate' => 1]);
            return $pdf->stream('certificate.pdf');
        }
    }
}
