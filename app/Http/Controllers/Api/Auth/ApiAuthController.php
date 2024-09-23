<?php

namespace App\Http\Controllers\Api\Auth;


use Session;
use App\User;
use Socialite;
use Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class ApiAuthController extends Controller

{
    use RedirectsUsers,
        ThrottlesLogins;
    // Register a new user
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    // Login a user and return the JWT token
    // This function will handle login using JWT
    public function login(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Attempt to authenticate the user with email
        if (Auth::guard('web')->attempt(['email' => $request->username, 'password' => $request->password], $request->remember)) {
            $user = User::where('email', $request->username)->first();
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token
            ], 200);
        }

        // If the first attempt fails, attempt with username (if applicable)
        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $user = User::where('username', $request->username)->first();
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token
            ], 200);
        }

        // Return error response if authentication fails
        return response()->json(['error' => 'Invalid email or password'], 401);
    }


    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'User successfully logged out'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to logout, please try again'
            ], 500);
        }
    }
















    // Logout a user
    // public function logout()
    // {
    //     JWTAuth::invalidate(JWTAuth::getToken());

    //     return response()->json(['message' => 'User successfully logged out']);
    // }

    // Get the authenticated user
    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }
}
