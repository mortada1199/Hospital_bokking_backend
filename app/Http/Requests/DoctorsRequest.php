<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required',
            'specialization' => 'string|required',
            'phone' => 'string|required',
            'address' => 'string|required'
        ];
    }
}
