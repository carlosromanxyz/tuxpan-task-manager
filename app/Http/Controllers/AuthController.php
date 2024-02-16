<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Register a user
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json(['user' => $user, 'token' => $user->createToken('tokens')->plainTextToken]);
    }

    /**
     * Login a user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        $password = Hash::check($request->password, $user->password);

        if (!$user || !$password) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // If the user is authenticated, set a message and return the token
        return response()->json(['message' => 'User authenticated succefully!', 'token' => $user->createToken('tokens')->plainTextToken]);
    }

    /**
     * Logout a user
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'User logged out successfully!']);
    }

    /**
     * Get the authenticated user
     */
    public function user(Request $request)
    {
        return $request->user();
    }
}
