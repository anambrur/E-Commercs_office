<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class ApiAuthController extends Controller
{
    use RedirectsUsers,
        ThrottlesLogins;

    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user', 'token'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while registering the user'], 500);
        }
    }

    /**
     * Login a user and return the JWT token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required_without:email',
            'email' => 'required_without:username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $user = User::where('email', $request->email)->first();

                if (!$user) {
                    return response()->json(['error' => 'User not found'], 404);
                }

                try {
                    $token = JWTAuth::fromUser($user);
                } catch (JWTException $e) {
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }

                return response()->json([
                    'message' => 'Login successful!',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }

            if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                $user = User::where('username', $request->username)->first();

                if (!$user) {
                    return response()->json(['error' => 'User not found'], 404);
                }

                try {
                    $token = JWTAuth::fromUser($user);
                } catch (JWTException $e) {
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }

                return response()->json([
                    'message' => 'Login successful!',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while trying to login'], 500);
        }

        return response()->json(['error' => 'Invalid email or password'], 401);
    }

    /**
     * Logout a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
}
