<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Course $course)
    {
        // dd($course);
        $course = $course->load('progress');
        return view('student.progress.index',['course' => $course]);
    }
    public function store(Request $request,Course $course)
    {
        $request->validate([
            'progress' => 'required'
        ]);
        

        // $data['user_id'] = auth()->user()->id;
        $data['course_id'] = $course->id;
        $data['progress'] = $request->progress;

        auth()->user()->progress()->create($data);
        session()->flash('progress_updated','Progress Updated Successfully');
        return redirect('home');
    }
    public function update(Request $request,Progress $progress)
{

    $request->validate([
        'progress' => 'required'
    ]);

    $progress_update = Progress::find($progress->id);


    $progress_update['progress'] = $request->progress;
    $progress_update->save();
    session()->flash('progress_updated','Progress Updated Successfully');
    return redirect('home');
}
}

