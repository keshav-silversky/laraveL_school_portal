<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
            return view('home');
        } else {
            $user = auth()->user();
            $courses = $user->load(['enroll']);
            $user->enroll->load(['payment' => function ($query) use ($user) {
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
