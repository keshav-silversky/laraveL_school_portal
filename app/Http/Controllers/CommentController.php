<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Course $course)
    {



        $comments = Comment::where('course_id', $course->id)->with('user')->orderBy('created_at', 'desc')->get();
        return view('student.comment',
        [
            'course' => $course,
            'comments' => $comments
        ]);
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $request->validate([
            'comment' => 'required | min:3'
        ]);
        $comment->comment = $request->comment;
        $comment->course_id = $request->course_id;
        auth()->user()->comments()->save($comment);
        session()->flash('success',"Comment Added Successfully");
        return back();
    }

    public function destroy(Comment $comment)
    {
        if(auth()->user()->id == $comment->user_id || auth()->user()->role == 'teacher' )
        {
            $comment->delete();
            session()->flash('deleted' , "Comment Deleted Successfully");
            return back();
        }
        else
        {
            session()->flash('not_deleted' , "Comment Cannot Be Deleted");
            return back();

        }
    }

}
