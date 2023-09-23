<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Policies\ProgressPolicy;

class ProgressController extends Controller
{
    public function index(Course $course)
    {
        // $this->authorize('view', $course);
        $course = $course->load(['progress' => function ($query) {
            return $query->whereUserId(auth()->user()->id);
        }]);
        return view('student.progress.index',['course' => $course]);
    }
    public function store(Request $request,Course $course)
    {
        // return $course;
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
    public function update(Course $course, Request $request, Progress $progress)
{

    
        // return $progress;
    $request->validate([
        'progress' => 'required'
    ]);
        Progress::find($progress->id)->update(['progress' => $request->progress]);
        session()->flash('progress_updated', 'Progress Updated Successfully');
        return redirect('home');
}


    public function certificate(Course $course, Progress $progress)
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
    public function certificate_upload(Request $request, Course $course, Progress $progress)
    {
        $this->authorize('update', $course);
   
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