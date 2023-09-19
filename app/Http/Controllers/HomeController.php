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
        if(auth()->user()->role == 'teacher')
        {
        return view('home');
        }
        else
        {
            $user = auth()->user();
            // $courses = $user->enroll()->get();
            // $courses = $user->enroll()->with('user')->get();
               //  $courses = $user->enroll()->with('user')->get();  
            //    $courses = $user->enroll()->with(['user' => function($query)
            //    {
            //     $query->select('*');
            //    }])->get();
            // $courses = $user->enroll()->with(['user','payments'])->get();

            $courses = $user->load(['enroll']);
            // $user->enroll->load(['payment','user','progress']);

                
            $user->enroll->load([
                'payment' => function($query)
                {
                return $query->whereUserId(auth()->user()->id);
                },
                'user',
                'progress' => function($query)
                {
                return $query->whereUserId(auth()->user()->id);
                }
        ]);

            // return $user->enroll[0]->progresses;
            
            
            return view('student.dashboard',[
                'courses' => $courses,
            ]);
        }
     
    }

    public function student_list(Course $course)
    {
     
        // $course = $course->load(['users' => function($query){
        //     return $query->where('id','!=',auth()->user()->id);
        // }]);
        $course = $course->load(['users' => function($query){
            return $query->where('id','!=',auth()->user()->id);
        }]);

 
        return view('student.list',['course' => $course]);

    }





}
