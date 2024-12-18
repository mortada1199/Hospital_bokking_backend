<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecializationController;
use App\Mail\NotifyUsersOfLatency;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;







Route::post('/register', [AuthController::class, 'register']); //route register
Route::post('/login', [AuthController::class, 'login']); //route login
Route::get('/GetAllDoctors', [DoctorController::class, 'GetAllDoctors']); //Get Doctors 
Route::get('/getAllSpecials', [SpecializationController::class, 'GetSpecial']); //Get specail
Route::post('/AddPatient', [PatientController::class, 'AddPatient']); //add Patient



Route::middleware('auth:sanctum')->group(function () { //scantoum  library
    Route::post('/logout', [AuthController::class, 'logout']); //route logout 

    //Doctor
    Route::post('/AddDoctors', [DoctorController::class, 'AddDoctors']); //add Doctors
    Route::put('/updateDoctors/{id}', [DoctorController::class, 'UpdateDoctors']); //update Doctors
    Route::delete('/deleteDoctors/{id}', [DoctorController::class, 'destroy']);

    //Special
    Route::post('/AddSpecial', [SpecializationController::class, 'AddSpecial']); //add Special
    Route::put('/updateSpecial/{id}', [SpecializationController::class, 'UpdateSpecial']); //update Special
    Route::delete('/deleteSpecial/{id}', [SpecializationController::class, 'Destroy']); //Delete Special

    //Patients 
    Route::get('/GetPatient', [PatientController::class, 'GetPatient']); //Get Patient
    Route::put('/ActiveStatus/{id}', [PatientController::class, 'ActiveStatus']); //ActiveStatus Special
    Route::put('/InActiveStatus/{id}', [PatientController::class, 'InActiveStatus']); //ActiveStatus Special

    //appointment
    Route::post('/AddAppointment', [AppointmentsController::class, 'store']); //add appointment
    Route::get('/GetAppointment/{id}', [AppointmentsController::class, 'GetAppointment']); //Get appointment
    Route::put('/UpdateAppointment/{id}', [AppointmentsController::class, 'UpdateAppointment']); //update appointment
});
