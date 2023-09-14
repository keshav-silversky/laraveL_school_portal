<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' => ['required','in:teacher,student','min:3'],
            "image" => ['required','file','max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "mob" => ['required','regex:/^[6-9]{1}[0-9]{9}$/'],
            "dob" => ['required','date'],
            "address" => ['required','min:3','max:200'],
            "gender" => ['required'],
            "hobbies" => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        dd($data);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

    $image = $data['image'];
    $filesave = $image->store('public/image');

        return User::create([
            'role' =>$data['role'],
            'image' => $filesave,
            'name' => $data['name'],
            'email' => $data['email'],
            'mob'=>$data["mob"],
            'dob'=> $data["dob"],
            'address'=>$data["address"] ,
            'gender'=>$data["gender"],
            'hobbies'=> implode("-",$data['hobbies']),
            'password' => Hash::make($data['password']),
        ]);
    }
}
