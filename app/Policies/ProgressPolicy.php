<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user,  Course $course)
    {
        $result = $course->payment()->whereUserId(auth()->user()->id)->first();
        if ($result->status == Config('constants.payment.approved')) {
            return true;
        } else {
            return false;
            abort(202);
        }
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Progress $progress, $course)
    {
        $user = auth()->user();
        if ($user->courses()->where($course->id)->exists()) {
            return true;
        } else {
            abort(403);
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Progress $progress)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Progress $progress)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Progress $progress)
    {
        //
    }
}
