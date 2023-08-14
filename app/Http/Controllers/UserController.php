<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function setPreferences(Request $request)
    {
        $updated = false;

        $categories = Category::all();
        foreach($categories as $category){
            if(auth()->user()->preferences()->where('category_id', $category->id)->exists() && $request->get($category->category) == null){
                auth()->user()->preferences()->detach($category);
            }
        }
        foreach ($request->all() as $key => $value) {
            if(Category::find($key) != null){
                if (Category::whereExists(function ($query) use ($key) {
                        $query->select(DB::raw(1))
                            ->from('user_preferences')
                            ->whereRaw('user_preferences.category_id = category.id')
                            ->where('user_id', auth()->id())
                            ->where('category_id', $key);
                    })->count() > 0) {
                    continue; // Skip attaching, move to the next category
                }

                // The category does not exist in user_preferences table, attach it
                auth()->user()->preferences()->attach($key);
                $updated = true;
            }
        }

        if ($updated) {
            return redirect()->back()->with('success', __('success.preferences_updated'));
        } else {
            return redirect()->back()->with('info', __('info.no_preferences'));
        }
    }

    public function editPreferences(){
        return view('student.preferences')->with([
            'categories' => Category::all(),
            'preferences' => auth()->user()->preferences
        ]);
    }

    /**
     * change the user role to instructor
     */
    public function instructor(){
        $user = User::findOrFail(auth()->id());
        $user->role = 2;
        $user->save();
        return redirect(route('instructorDashboard'));
    }

    
    public function instructorIndex(){
        return view('instructor.dashboard')->with([
            'courses' => Course::whereHas('instructors', function ($query){
              $query->where('instructor_id', auth()->id());
            })->get()
        ]);
    }

    public function studentDashboard(){
        return view('student.dashboard')->with('courses', Course::whereHas('students', function($query){
            $query->where('student_id', auth()->id());
        })->get());
    }
}
