<?php

namespace App\Custom;

use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;

trait Certificate{
    public static function generate($course){
        $studentName = auth()->user()->full_name;
        $courseName = Course::findOrFail($course)->title;
        $pdf = PDF::loadView('certificate', compact('studentName', 'courseName'));
        return $pdf->stream('certificate.pdf');
    }
}
