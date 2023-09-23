<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'teacher') {
            $user = auth()->user();

            // $user = User::find($user->id);




            $user->loadCount('courses')->loadSum('paymentSum', 'amount'); // Right
            // $user->loadCount(['courses'])->courses()->withCount('students')->get()]); // Right
            $user['students'] = $user->courses()->whereHas('students')->withCount('students')->get()->sum('students_count');

            // dd($user);
            return view('home', ['user' => $user]); // ['count' => $count]








            // $count['courses'] = $user->courses()->count();
            // $count['payments'] = $user->courses()->whereHas('payments')->withCount('payments')->get()->sum('payments_count');
            // $count['students'] = $user->courses()->whereHas('students')->withCount('students')->get()->sum('students_count');


            return view('home'); // ['count' => $count]

        } else {
            $user = auth()->user();
            $courses = $user->load(['enroll']);
            $user->enroll->load([
                'payment' => function ($query) use ($user) {
                    return $query->whereUserId($user->id);
                },
                'user',
                'progress' => function ($query) use ($user) {
                    return $query->whereUserId($user->id);
                }
            ]);


            return view('student.dashboard', [
                'courses' => $courses,
            ]);
        }
    }

    public function studentList(Course $course)
    {
        $this->authorize('view', $course);
        $result = auth()->user()->enroll;

        $course = $course->load(['users' => function ($query) {
            return $query->where('id', '!=', auth()->user()->id);
        }]);


        return view('student.list', ['course' => $course]);
    }
}
