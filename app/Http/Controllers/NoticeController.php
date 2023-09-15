<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Course $course)
    {
   
        $notices = Notice::where('course_id',$course->id)->get();
        return view('teacher.courses.notice',[
            'notices' => $notices,
            'course' => $course
        ]);
    }

    public function store(Course $course ,Request $request)
    {
        $request->validate([
            'subject' => 'required | min:3',
            'description' => 'required | min:3'
        ]);

      $notice = new Notice;
      $notice->subject = $request->subject;
      $notice->description = $request->description;

      $course->notices()->save($notice);
      session()->flash('notice_created',"Notice Created Successfully");
      return back();
    }

    public function destroy(Notice $notice)
    {
        $notice->delete($notice->id);
        session()->flash('deleted',"Notice Deleted Successfully");
        return back();
    }
}
