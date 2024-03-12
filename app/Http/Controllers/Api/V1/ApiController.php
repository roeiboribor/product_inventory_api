<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginUserRequest;
use App\Http\Requests\Api\Authentication\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Register a user
     *
     * @param  mixed $request
     * @return void
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $status = false;
        $message = 'Oops! Something went wrong!';
        $token = null;

        try {
            $data = $request->validated();

            $data['password'] = Hash::make('password');
            $user = User::create($data);
            $token = $user->createToken('API Token')->accessToken;

            if ($user) {
                $status = true;
                $message = "User has been created!";
            }
        } catch (\Exception $err) {
            \Log::error("Error: Register user details. " . $err);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'token' => $token,
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $response = [
            'status' => false,
            'message' => "Incorrect details... Please try again!",
        ];

        try {
            $data = $request->validated();

            if (auth()->attempt($data)) {
                $response = [
                    'status' => true,
                    'message' => "You have successfully logged in!",
                    'user' => auth()->user(),
                    'token' => auth()->user()->createToken('Login API Token')->accessToken
                ];
            }
        } catch (\Exception $err) {
            \Log::error("Error: Login user details. " . $err);
        }

        return response()->json([
            ...$response
        ]);
    }

    public function profile()
    {
        $response = [
            'status' => false,
            'message' => "Oops! Something went wrong!",
        ];

        $user = auth()->user();

        if ($user) {
            $response = [
                'status' => true,
                'message' => "Profile Details!",
                'data' => $user
            ];
        }

        return response()->json([
            ...$response
        ]);
    }

    public function logout()
    {
        $response = [
            'status' => false,
            'message' => "Oops! Something went wrong!",
        ];

        try {
            auth()->user()->token()->revoke();

            $response = [
                'status' => true,
                'message' => 'User logged out'
            ];
        } catch (\Exception $err) {
            \Log::error("Error: Logout user. " . $err);
        }

        return response()->json([
            ...$response
        ]);
    }
}
