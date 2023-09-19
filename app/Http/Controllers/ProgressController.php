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
        $course = $course->load(['progress' => function ($query) {
            return $query->whereUserId(auth()->user()->id);
        }]);
      
        return view('student.progress.index',['course' => $course]);
    }
    public function store(Request $request,Course $course)
    {
        $request->validate([
            'progress' => 'required'
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['course_id'] = $course->id;
        $data['progress'] = $request->progress;

        Progress::create($data);
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


    public function certificate(Progress $progress)
    {
        Progress::find($progress->id)->update(['certificate' => Config('constants.progress.certificate')]);
        session()->flash('certificate', "Requested For Certificate");
        return back();
}

    public function view_certificate()
    {
        $user = auth()->user();

        $user->load('courses');
        $user->courses->load(['progresses' => function ($query) {
            return $query->where('progress', '100')->where('certificate', Config('constants.progress.certificate'))->with('user');
        }]);

        return view('teacher.progress.certificate', ['user' => $user]);
    }
    public function certificate_upload(Request $request, Progress $progress)
    {
        $request->validate([
            'certificate' => 'required | file | mimes:pdf'
        ]);
        if ($file = $request->file('certificate')) {
            $filesave = $file->store('public/certificate');
        }
        Progress::find($progress->id)->update(['certificate' => $filesave]);
        session()->flash('certificate', "Certificate Upload Successfully");
        return back();
    }
}