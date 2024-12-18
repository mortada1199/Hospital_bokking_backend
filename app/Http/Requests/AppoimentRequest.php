<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppoimentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comments' => 'required',
            'date' => 'required',
            'patient_id'=>'required'
        ];
    }
}
