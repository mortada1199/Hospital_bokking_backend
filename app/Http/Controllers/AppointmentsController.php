<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppoimentRequest;
use App\Http\Requests\UpdateAppoimentRequest;
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


    //update a appointment
    public function update(UpdateAppoimentRequest $request, $id)
    {
        //find the appointment
        $appointment = Appointments::find($id);

        //update the appointment
        $appointment->update($request->all());

        //send a success message
        return response()->json([
            'message' => 'Appointment updated successfully!',
            'appointment' => $appointment
        ], 200);
    }

    public function index()
    {
        $appointments = Appointments::with('patient')->get();

        if ($appointments) {
            return response()->json([
                'appointment' => $appointments
            ], 200);
        } else {
            return response()->json([
                'error' => 'No appointments found'
            ], 404);
        }
    }
}
