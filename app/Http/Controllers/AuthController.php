<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function index(Request $request) {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        // Check if email exists and password is correct
        if(!$user || !Hash::check($validated['password'], $user->password)) {
            return response('Unauthorized!', 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'message' => 'Login Successful!',
            'token' => $token
        ], 200);
    }

    // Register
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:20'
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Logout
    public function destroy(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json('Logout Successful!', 200);
    }
}
