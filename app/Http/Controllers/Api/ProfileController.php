<?php

namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use App\Model\Common\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfile()
    {
        if (auth()->user() === null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth()->user();

        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        try {
            $orders = Order::where('user_id', $user->id)->with('detail')->get();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }

        if ($orders === null) {
            return response()->json(['error' => 'Orders not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'orders' => $orders
        ], 200);
    }




    public function updateProfile(Request $request)
    {
        // dd($request->all());
        if (auth()->user() === null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user_data = auth()->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user_data->id,
            'password' => 'nullable|string|min:6|confirmed', // Make password optional
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        if ($user_data === null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        try {
            $user = User::find($user_data->id);

            // dd($request->company);
            $user->firstname  = $request->first_name;
            $user->lastname = $request->last_name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;

            // Only update the password if it's provided
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->username = $request->email;

            // Billing information
            $user->company  = $request->company  ?? null;
            $user->address = $request->address ?? null;
            $user->country = $request->country ?? null;
            $user->state = $request->state ?? null;
            $user->city = $request->city ?? null;
            $user->zip = $request->zip ?? null;

            $user->billing_firstname = $request->billing_firstname ?? null;
            $user->billing_lastname = $request->billing_lastname ?? null;
            $user->billing_mobile = $request->billing_mobile ?? null;
            $user->billing_company = $request->billing_company ?? null;
            $user->billing_address = $request->billing_address ?? null;
            $user->billing_country = $request->billing_country ?? null;
            $user->billing_state = $request->billing_state ?? null;
            $user->billing_city = $request->billing_city ?? null;
            $user->billing_zip = $request->billing_zip ?? null;

            $user->job_title = $request->job_title ?? null;
            $user->image = $request->image ?? null;
            $user->status = 1;

            $user->update(); // Eloquent handles updated_at automatically




        } catch (\Exception $e) {
            // Return the actual error message to debug
            return response()->json(['error' => 'An error occurred while updating the user' . $e->getMessage()], 500);
        }

        return response()->json([
            'status' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }
}
