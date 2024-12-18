<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'doctor' => 'required',
            'specialization' => 'required',
            'date' => 'required',
            'email' => 'string|required',
            'phone' => 'string|required',
            'patientName' => 'string|required',
            'address' => 'string|required'

        ];
    }
}
