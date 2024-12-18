<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;


class SpecializationController extends Controller
{

    /**
     * @OA\Post(
     * path="/api/AddSpecial",
     * operationId="add-Special",
     * tags={"Specialization"},
     * summary="add Special",
     * description="Register Special ",
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
     *               required={"special"},
     *               @OA\Property(property="special", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="special created successfully",
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
    //add special
    public function AddSpecial(SpecialRequest $specialrequest)
    {

        $special = Specialization::create(
            [
                'special' => $specialrequest->special,
            ]
        );
        if ($special) {
            return response()->json(

                [
                    'statusCode' => 200,
                    'special' =>   $special,
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'special' =>   "No Data",
                ]
            );
        }
    }



    /**
     * @OA\get(
     * path="/api/getAllSpecials",
     * operationId="get-Special",
     * tags={"Specialization"},
     * summary="get Special",
     * description="get Special ",
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
     *               required={""},
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

    //show special
    public function GetSpecial(Request $request)
    {

        $special = Specialization::all();
        if ($special) {
            return response()->json(
                [
                    'statusCode' => 200,
                    'special' =>   $special
                ]
            );
        } else {
            return response()->json(
                [
                    'statusCode' => 404,
                    'special' =>   " Data Not Found!"
                ]
            );
        }
    }




    /**
     * @OA\put(
     * path="/api/updateSpecial/{id}",
     * operationId="updateSpecial",
     * tags={"Specialization"},
     * summary="update Special",
     * description="update  Special  Here",
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
     *               @OA\Property(property="special", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Special updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="statusCode", type="int"),
     *               @OA\Property(property="special", type = "string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */
    //update special
    public  function UpdateSpecial(Request $request, $id)
    {
        $special = Specialization::find($id);

        if ($special) {
            $special->update([
                'special' => $request->special ?? $special->special
            ]);

            return response()->json(

                [
                    'statusCode' => 200,
                    'special' =>   " Update Success",
                    'data' => $special
                ]
            );
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'special' =>   " Data Not Found! "
                ]
            );
        }
    }



    /**
     * @OA\delete(
     * path="/api/deleteSpecial/{id}",
     * operationId="deleteSpecial",
     * tags={"Specialization"},
     * summary="Delete Special",
     * description="delete Special here",
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
     *          description="Special deleted successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Data Not Found!"),
     * )
     */
    //delete special
    public function Destroy($id)
    {
        $doctor = Specialization::find($id);
        if ($doctor) {
            $doctor->delete();
            return $doctor;
        } else {
            return response()->json(

                [
                    'statusCode' => 404,
                    'doctor' =>   " Data Not Found! "
                ]
            );
        }
    }
}
