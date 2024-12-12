<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function registration(AuthRequest $request)
    {
        $validator = $request->validated();

        $profile = Profile::create([
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
            'gender' => $validator['gender']
        ]);

        $token = $profile->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $profile,
            'token' => $token
        ], 201);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
