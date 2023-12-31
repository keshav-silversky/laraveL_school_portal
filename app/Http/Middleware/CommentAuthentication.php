<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $course = $request->route('course');
        // DB::connection()->enableQueryLog();
        if ($user->enroll()->where('course_id', $course->id)->exists() || $user->courses()->where('id', $course->id)->exists()) {
            return $next($request);
        } else {
            return back();
        }
        // dd(DB::getQueryLog());
    }
}
