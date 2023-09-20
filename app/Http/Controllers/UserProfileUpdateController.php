<?php

namespace App\Http\Controllers;

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

    public function update(Request $request, User $user)
    {
        $request->validate([
            // "image" => ['required', 'file', 'size:2048'],
            "name" => ['required', 'min:3', 'max:100'],
            "email" => ['required', 'email', 'unique:users'],
            "mob" => ['required', 'numeric', 'min:10', 'max:10'],
            "dob" => ['required', 'date', 'after:2011-01-01', "before" => Carbon::now()],
            "address" => ['required', 'min:3', 'max:200'],
            "gender" => ['required'],
            "hobbies" => ['required'],
        ]);
    }
}
