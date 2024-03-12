<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginUserRequest;
use App\Http\Requests\Api\Authentication\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register a user
     *
     * @param  mixed $request
     * @return void
     */
    public function store(RegisterUserRequest $request): JsonResponse
    {
        $responses = [
            'status' => 500,
            'message' => 'Oops! Something went wrong!',
        ];

        try {
            $data = $request->validated();
            $data['password'] = Hash::make('password');
            $user = User::create($data);
            $token = $user->createToken('Register API Token')->accessToken;
            $responses = [
                'status' => 200,
                'message' => 'User has been created!',
                'token' => $token,
            ];
        } catch (\Exception $err) {
            \Log::error("Error: Register user details. " . $err);
        }

        return response()->json([
            ...$responses
        ], $responses['status']);
    }
}
