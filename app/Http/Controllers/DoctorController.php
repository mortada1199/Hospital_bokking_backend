<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorsRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{


/**
     * @OA\Post(
     * path="/api/AddDoctors",
     * operationId="add-doctors",
     * tags={"Doctors"},
     * summary="add doctors",
     * description="Register doctors ",
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
     *               required={"name","specialization","phone","address"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="specialization", type="string"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="address", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Doctor created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */


    //Add Doctor 

    public function AddDoctors(DoctorsRequest $doctorsRequest)
    {
        $doctor = Doctor::create(
            [
                'name' => $doctorsRequest->name,
                'specialization' => $doctorsRequest->specialization,
                'phone' => $doctorsRequest->phone,
                'address' => $doctorsRequest->address,
            ]
        );
        if ($doctor != null) {
            return response()->json(

                [
                    'statusCode' => 200,
                    'doctor' =>   $doctor,
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'doctor' =>   "No Data",
                ]
            );
        }
    }

 /**
  * * @OA\Info(
 *     title="Doctor API",
 *     version="1.0.0",
 *     description="API for managing doctors",
 *     @OA\Contact(
 *         email="murtada199815@gmail.com"
 *     )
 * ),
     * @OA\get(
     * path="/api/GetAllDoctors",
     * operationId="get-doctors",
     * tags={"Doctors"},
     * summary="get-doctors ",
     * description="get-doctors Here",
     *         @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="statusCode", type="integer"),
     *               @OA\Property(property="doctor", type="object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found! "),
     * )
     */

    //Get all Doctor
    public function GetAllDoctors(Request $request)
    {

        $doctors = Doctor::all();

        if ($doctors != null) {
            return response()->json(

                [
                    'statusCode' => 200,
                    'doctor' =>   $doctors,
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'doctor' =>   " Data Not Found! ",
                ]
            );
        }
    }



/**
     * @OA\put(
     * path="/api/Doctors/{id}",
     * operationId="updatedoctor",
     * tags={"Doctors"},
     * summary="update doctor",
     * description="update  doctor  Here",
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
     *          description="doctor updated successfully",
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

    public  function UpdateDoctors(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $doctor->update([
                'name' => $request->name ?? $doctor->name,
                'specialization' => $request->specialization ?? $doctor->specialization,
                'phone' => $request->phone ?? $doctor->phone,
                'address' => $request->address ?? $doctor->address
            ]);

            return response()->json(

                [
                    'statusCode' => 200,
                    'doctor' =>   " Update Success ",
                    'data' =>   $doctor
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'doctor' =>   " Data Not Found! "
                ]
            );
        }
    }



/**
     * @OA\delete(
     * path="/api/deleteDoctors/{id}",
     * operationId="deleteDoctors",
     * tags={"Doctors"},
     * summary="Delete Doctor",
     * description="delete Doctor here",
     *     @OA\Parameter(
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=301,
     *          description="doctor deleted successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */

    //delete function 
    public function Destroy($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            $doctor->delete();
            return $doctor;
        }
        else{
            return response()->json(

                [
                    'statusCode' => 404,
                    'doctor' =>   " Data Not Found! "
                ]
            ); 
        }
       
    }
}
