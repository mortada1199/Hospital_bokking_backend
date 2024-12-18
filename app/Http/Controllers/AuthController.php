<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    /**
     * @OA\Post(
     * path="/api/register",
     * operationId="add-user",
     * tags={"Auth"},
     * summary="add user",
     * description="Register user ",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email","password","phone", "address"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="address", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object"),
     *                @OA\Property(property="token", type="string")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */


    //register Function 

    public function register(RegisterRequest $registerRequest)
    {

        $user = User::create(
            [
                'name' => $registerRequest->userName,
                'email' => $registerRequest->email,
                'password' => $registerRequest->password,
                'phone' => $registerRequest->phone,
                'address' => $registerRequest->address
            ]
        );
        $token = $user->createToken($registerRequest->userName);


        return response()->json(

            [
                'statusCode' => 200,
                'user' =>   $user,
                'token' => $token->plainTextToken
            ]
        );
    }





 /**
     * @OA\Post(
     * path="/api/login",
     * operationId="login-user",
     * tags={"Auth"},
     * summary="login user",
     * description="login user ",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"password","email"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User login successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="statusCode", type="int"),
     *               @OA\Property(property="user", type="object"),
     *                @OA\Property(property="token", type="string")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=300, description="The Provided credentials are incorrect"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */


    //login function 
    public function login(LoginRequest $loginRequest)
    {

        $user = User::where('email', $loginRequest->email)->first();

        if (!$user || !Hash::check($loginRequest->password, $user->password)) {
            return response()->json(

                [
                    'statusCode' => 300,
                    'message' =>   'The Provided credentials are incorrect'
                ]
            );
        }
        $token = $user->createToken($user->name);


        return response()->json(

            [
                'statusCode' => 200,
                'user' =>   $user,
                'token' => $token->plainTextToken
            ]
        );
    }

/**
     * @OA\Post(
     * path="/api/logout",
     * operationId="logout-user",
     * tags={"Auth"},
     * summary="logout user",
     * description="logout user ",
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
     *               @OA\Property(property="", type="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="You are logged out.",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    //logout function 
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(

            [
                'statusCode' => 200,
                'message' => 'You are logged out.'
            ]
        );
    }
}
