<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Course $course)
    {
        if ($user->enroll()->where('course_id', $course->id)->exists()) {
            return true;
        } else {
            abort(403, 'jsdh');
        }
    }
}
