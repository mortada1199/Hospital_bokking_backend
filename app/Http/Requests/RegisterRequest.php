<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userName' => 'string|required',
            'password' => 'string|required',
            'email' => 'required|email',
            'phone' => 'string|required',
            'address' => 'string|required'
        ];
    }
}
