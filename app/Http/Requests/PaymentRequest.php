<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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

    /**s
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required | min:3',
            'card' => 'required | min:16 | max:16',
            'cvv' => 'required | min:3 | max:3',
            'expiry_date' => ['required' , 'after:' . Carbon::now() ],
            'pdf' => 'required | file | mimes:pdf'
        ];
    }
}
