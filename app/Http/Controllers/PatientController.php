<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Notifications\WelcomeEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{


    /**
     * @OA\Post(
     * path="/api/AddPatient",
     * operationId="add-Patient",
     * tags={"Patient"},
     * summary="add Patient",
     * description="Register Patient ",
     *        @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"doctor","specialization","date","email","phone","patientName","address"},
     *               @OA\Property(property="doctor", type="string"),
     *               @OA\Property(property="specialization", type="string"),
     *               @OA\Property(property="date", type="date"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="patientName", type="string"),
     *               @OA\Property(property="address", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="patient created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="statusCode", type="int"),
     *               @OA\Property(property="patient", type="object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="No Data"),
     * )
     */

    //add  patient
    public function AddPatient(PatientRequest $patientRequest)
    {

        $patient = Patient::create(
            [
                'doctor' => $patientRequest->doctor,
                'specialization' => $patientRequest->specialization,
                'date' => $patientRequest->date,
                'email' => $patientRequest->email,
                'phone' => $patientRequest->phone,
                'patientName' => $patientRequest->patientName,
                'address' => $patientRequest->address,
            ]
        );

    

        if ($patient) {
            return response()->json(

                [
                    'statusCode' => 200,
                    'patient' =>   $patient,
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'patient' =>   "No Data",
                ]
            );
        }
    }




    
    /**
     * @OA\get(
     * path="/api/GetPatient",
     * operationId="get-Patient",
     * tags={"Patient"},
     * summary="get Patient",
     * description="get Patient ",
     *        @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="", type=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="statusCode", type="int"),
     *               @OA\Property(property="patient", type="object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */

//show patient
    public function GetPatient(Request $request)
    {

        $patient = Patient::all();

        if ($patient != null) {

            return response()->json(

                [
                    'statusCode' => 200,
                    'patient' =>   $patient
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'patient' =>   " Data Not Found!"
                ]
            );
        }
    }





    
/**
     * @OA\put(
     * path="/api/ActiveStatusStatus/{id}",
     * operationId="ActiveStatusPatient",
     * tags={"Patient"},
     * summary="update Patient",
     * description="update  Patient  Here",
     *         @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="specialization", type="string"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="address", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Patient updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */

//update function

public  function ActiveStatus(Request $request, $id)
{
    $patient = Patient::find($id);

    if ($patient) {
        $patient->update([
            'status' => 'Active',
            'BeginOfPreview'=> Carbon::now()
        ]);

        return response()->json(

            [
                'statusCode' => 200,
                'patient' =>   " Update Success ",
                'data' =>   $patient
            ]
        );
    } else {
        return response()->json(

            [
                'statusCode' => 404,
                'patient' =>   " Data Not Found! "
            ]
        );
    }
}



/**
     * @OA\put(
     * path="/api/InActiveStatusStatus/{id}",
     * operationId="InActiveStatusPatient",
     * tags={"Patient"},
     * summary="update Patient",
     * description="update  Patient  Here",
     *         @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="specialization", type="string"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="address", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Patient updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */

public  function InActiveStatus(Request $request, $id)
{
    $patient = Patient::find($id);

    if ($patient) {
        $patient->update([
            'status' => 'InActive',
            'endOfPreview'=>Carbon::now()
        ]);

        return response()->json(

            [
                'statusCode' => 200,
                'patient' =>   " Update Success ",
                'data' =>   $patient
            ]
        );
    } else {
        return response()->json(

            [
                'statusCode' => 404,
                'patient' =>   " Data Not Found! "
            ]
        );
    }
}
}
