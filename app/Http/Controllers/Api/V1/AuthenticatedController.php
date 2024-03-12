<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginUserRequest;
use App\Http\Requests\Api\Authentication\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    /**
     * Login the user details
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(LoginUserRequest $request): JsonResponse
    {
        $responses = [
            'status' => 401,
            'message' => "Incorrect details... Please try again!",
        ];

        try {
            $data = $request->validated();

            if (auth()->attempt($data)) {
                $responses = [
                    'status' => 200,
                    'message' => "You have successfully logged in!",
                    'token' => auth()->user()->createToken('LaravelAuthApp')->accessToken
                ];
            }
        } catch (\Exception $err) {
            \Log::error("Error: Login user details. " . $err);
        }

        // MAKE SURE TO SAVE THE TOKEN ON THE FRONTEND VIA COOKIE
        return response()->json([
            ...$responses
        ], $responses['status']);
    }

    /**
     * Logout current authenticated user
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        $responses = [
            'status' => 500,
            'message' => "Oops Something went wrong!",
        ];

        try {
            auth()->user()->token()->revoke();

            $responses = [
                'status' => 200,
                'message' => 'User logged out'
            ];
        } catch (\Exception $err) {
            \Log::error("Error: Logout user. " . $err);
        }

        return response()->json([
            ...$responses
        ], $responses['status']);
    }
}
