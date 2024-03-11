<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(StoreUserRequest $request)
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
        // $validated = $request->validated();
        // $fails = $request->fails();
        // \Log::info($validated);
        // dd($validated, $fails);

        // $user = User::create($request->validated());
        // dd($user);

        return response()->json([
            'status' => $status,
            'message' => $message,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
    }

    public function profile()
    {
    }

    public function logout()
    {
    }
}
