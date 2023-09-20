<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProfileUpdateController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        return view('update', ['user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {

        $user = User::find($user->id);

        $user->name = $request->name;
        $user->mob = $request->mob;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->hobbies = implode('-', $request->hobbies);

        if ($file = $request->file('image')) {
            $filesave = $file->store('public/image');
            $user->image = $filesave;
        }


        if ($user->isDirty(['name', 'mob', 'dob', 'gender', 'address', 'hobbies', 'image'])) {
            $user->save();
            session()->flash('updated', 'Profile Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('nothing_changed', 'Nothing To Change');
            return back();
        }


    }
}
