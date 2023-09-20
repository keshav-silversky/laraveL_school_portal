<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // "role" => ['required'],
            // "image" => ['required','file','size:2048'],
            // "name" => ['required','min:3','max:100'],
            // "email" => ['required','email','unique:users'],
            // "mob" => ['required','numeric','min:10','max:10'],
            // "dob" => ['required', 'date', "before" => Carbon::now()],
            //     "address" => ['required','min:3','max:200'],
            //     "gender" => ['required'],
            //     "hobbies" => ['required'],
            //     "password" => ['required','min:8','max:40']
        ];
    }
}
