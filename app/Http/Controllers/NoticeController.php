<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    public function index(Course $course)
    {

        $notices = Notice::where('course_id', $course->id)->get();
        return view('teacher.courses.notice', [
            'notices' => $notices,
            'course' => $course
        ]);
    }

    public function store(Course $course, Request $request)
    {
        $request->validate([
            'subject' => 'required | min:3',
            'description' => 'required | min:3'
        ]);

        $notice = new Notice;
        $notice->subject = $request->subject;
        $notice->description = $request->description;

        $course->notices()->save($notice);
        session()->flash('notice_created', "Notice Created Successfully");
        return back();
    }

    public function destroy(Notice $notice)
    {
        $notice->delete($notice->id);
        session()->flash('deleted', "Notice Deleted Successfully");
        return back();
    }

    public function show(User $user)
    {

        $user->load(['enroll.payment' => function ($query) use ($user) {
            $query->where('status', Config('constants.payment.approved'))->with('course.notices');
        }]);
        return view('student.notice', ['data' => $user]);

        // $user->load(['enroll.payment' => function ($query) use ($user) {
        //     $query->where('status', Config('constants.payment.approved'));
        // }])->with('course.notices');
        // return view('student.notice', ['data' => $user]); // Working 




        // $notices = Notice::whereHas('payment', function ($query) use ($user) {
        //     $query->where('status', Config('constants.payment.approved'))
        //     ->where('student_id', $user->id);
        // })
        //     ->with(['payment.course'])
        //     ->get();
        // $filteredNotices = $notices->pluck('payment.course.notices')->flatten();


        // return $filteredNotices;
        //     return $user->enroll;

        //  $user->load(['enroll.notices.course.payment' => function ($query) use ($user) {
        //         $query->where('status', Config('constants.payment.approved'));
        //     }]);
        //     return view('student.notice', ['user' => $user]);

        // $user->load(['enroll.payment' => function ($query) use ($user) {
        //     $query->where('status', Config('constants.payment.approved'))->with('course.notices');
        // }]);
        // echo "<pre>";
        // foreach ($user->enroll as $course) {

        //     foreach ($course->notices as $pay) {
        //         // dd($course->name);
        //     }
        // }
        // exit;
        // Enroll->payment->course->notice


        // $user->load(['enroll.notices.course.payment' => function ($query) use ($user) {
        //     $query->where('status', Config('constants.payment.approved'));
        // }]);


        // return view('student.notice', ['user' => $user]);


        // $user->load(['enroll.notices.course.payment' => function ($query) {
        //     $query->where('status', Config('constants.payment.approved'));
        // }]);


        // $user->payments->course->load(['notices']);
        // return $user;
        // $payments =  $user->payments()->where('status', Config('constants.payment.approved'))->get();
        // $notices =  $payments->notices()->where('course_id', $payments[0]->course_id)->get();

        // $payments->load(['notices' => function ($query) use ($payments) {
        //     return $query->whereCourseId($payments[0]->course_id);
        // }]);
        // $user->load(['payments' => function ($query) {
        //     return $query->where('status', Config('constants.payment.approved'));
        // }]);
        // $user->payments->load(['notices' => function ($query) use ($user) {
        //     return $query->whereCourseId($user->payments->course_id);
        // }]);


    }
}
