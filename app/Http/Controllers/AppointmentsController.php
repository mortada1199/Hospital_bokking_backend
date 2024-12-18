<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppoimentRequest;
use App\Models\Appointments;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    //create a new appointments
    public function store(AppoimentRequest $request)
    {

        //function crete 
        $appointment = Appointments::create([
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'comments' => $request->comments,
        ]);

        //send a success message
        return response()->json([
            'message' => 'Appointment created successfully!',
            'appointment' => $appointment
        ], 201);
    }





    
}
