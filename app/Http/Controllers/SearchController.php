<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function searchByStudent(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);


        // $result = User::with('enroll.user')->whereId(Auth::id())->get(); // Working
        // $result = User::with(['enroll' => function ($query) use ($request) {
        //     $query->where('name', 'like', "%$request->search%")->with(['user' => function ($userQuery) use ($request) {
        //         $userQuery->where('name', 'like', "%$request->search%");
        //     }]);
        // }])->whereId(Auth::id())->get();


        // $result = User::with(['enroll' => function ($query) use ($request) {
        //     $query->where('name', 'like', "%$request->search%")->with(['user' => function ($UserQuery) use ($request) {
        //         $UserQuery->Orwhere('name', 'like', "%$request->search%");
        //     }]);
        // }])->whereId(Auth::id())->get();
        $result = User::with(['enroll' => function ($query) use ($request) {
            $query->where('name', 'like', "%$request->search")
                ->orWhereHas('enroll', 'user', function ($userQuery) use ($request) {
                    $userQuery->where('name', 'like', "%$request->search");
                })->get();
        }])->whereId(Auth::id())->get();

        return $result;
        ddd($result);



        // $result = User::with(['enroll' => function ($query) use ($request) {
        //     $query->where('name', 'like', "%$request->search%")->with('user');
        // }])->with(['enroll.user' => function ($query) use ($request) {
        //     $query->where('name', 'like', "%$request->search%");
        // }])->whereId(Auth::id())->get();


    }
}
