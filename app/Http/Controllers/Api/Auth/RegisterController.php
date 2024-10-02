<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Validator;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'username' => $request->email,
            'mobile' => $request->email,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json([
            'message' => 'Registration successful!',
            'user' => $user,
            // 'token' => $token
        ]);
    }
}
