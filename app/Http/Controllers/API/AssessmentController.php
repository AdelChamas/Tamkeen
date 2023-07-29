<?php



namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assessment;

class AssessmentController extends Controller{

    public function index(){
        return Assessment::all();
    }

    public function show(){

    }
}
