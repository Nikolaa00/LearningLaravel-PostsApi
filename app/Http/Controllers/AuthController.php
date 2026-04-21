<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            "message" => "Registration successful",
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
            ],
            "token" => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            "message" => "Login successful",
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
            ],
            "token" => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'userEmail' => $request->user()->email,
            "message" => "Logged out successfully"
        ]);
    }
}