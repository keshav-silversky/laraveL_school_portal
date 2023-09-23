<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = auth()->user()->courses()->orderBy('id', 'desc')->paginate(5);

        
        return view('teacher.courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            $course = new Course;
            $image = $request->file('image');
            $filesave = $image->store('public/course');
            $course->name = $request->name;
            $course->price = $request->price;
            $course->image = $filesave;
            auth()->user()->courses()->save($course);
            session()->flash('created', 'Course Created Successfully');
            return back();
        } catch (Throwable $t) {
            session()->flash('not_created', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $this->authorize('view', $course);
        $course->load(['students']);
        $course->students->load(['progress' => function ($query) use ($course) {
            return $query->whereCourseId($course->id);
        }]);

        return view('teacher.courses.view_enroll', ['course' => $course]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $this->authorize('view', $course);
        return view('teacher.courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course)
    {
        $this->authorize('update', $course);
        $inputs = request()->validate([
            'image' => 'mimes:jpg,png,PNG,jpeg',
            'name' => 'required | string | min:3 ',
            'price' => 'required | numeric | min:2'
        ]);
        $course->name = $inputs['name'];
        $course->price = $inputs['price'];
        if ($image = request()->file('image')) {
            $filesave = $image->store('public/course');
            $course->image = $filesave;
        }

        if ($course->isDirty()) {
            // $course->save();
            auth()->user()->courses()->save($course);
            session()->flash('updated', "Course Updated Successfully");
            return back();
        } else {
            session()->flash('not_updated', "Nothing To Update");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $this->authorize('delete', $course);
        try {
            Course::find($course->id)->delete(); // findOrFail
            session()->flash('deleted', 'Course Deleted Successfully');
            return back();
        } catch (Throwable $t) {
            session()->flash('not_deleted', "Something Went Wrong");
            return back();
        }
    }

    public function enroll(Course $course)
    {
        $this->authorize('view', $course);
        return view(
            'teacher.courses.enroll',
            [
                'course' => $course,
                'users' => User::where('role', 'student')->paginate(10)

            ]
        );
    }

    public function attach(User $user, Request $request)
    {

        $user->enroll()->attach($request->course_id);
        session()->flash('attached', "Student Attached Successfully");
        return back();
    }
    public function detach(User $user, Request $request)
    {

        $user->enroll()->detach($request->course_id);
        session()->flash('detached', "Student Detached Successfully");
        return back();
    }

    // public function viewNotice(Course $course)
    // {
    //     $notices = Notice::where('course_id',$course->id)->get();
    //     return view('teacher.courses.notice',[
    //         'notices' => $notices,
    //         'course' => $course
    //     ]);
    // }



}
