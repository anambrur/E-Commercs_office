<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required_without_all:email,mobile',
    //         'email' => 'required_without_all:username,mobile',
    //         'mobile' => 'required_without_all:email,username',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->messages()], 400);
    //     }

    //     try {
    //         // Attempt login with email
    //         if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    //             $user = User::where('email', $request->email)->first();
    //         }
    //         // Attempt login with username
    //         elseif (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
    //             $user = User::where('username', $request->username)->first();
    //         }
    //         // Attempt login with mobile
    //         elseif (Auth::guard('web')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {

    //             $pin = rand(1111, 9999);

    //             $to = $request->mobile;
    //             $message = "Your One time Login PIN for Classified is " . $pin . ". It will expire in 3 minutes.";

    //             try {
    //                 $user_info = User::where("mobile", $to)->first();

    //                 if (!empty($user_info)) {
    //                     $user_info->update([
    //                         'otp' => $pin,
    //                     ]);
    //                 } else {
    //                     $flag = User::create([
    //                         'mobile' => $to,
    //                         'otp' => $pin,
    //                         'status' => '1',
    //                         'username' => $to,
    //                     ]);
    //                 }

    //                 $url = "http://139.99.39.237/api/smsapi?api_key=mPs3CslIA2tXhyrIqMip&type=text&number=Receiver&senderid=8809617613457&message=TestSMS";
    //                 $data = array(
    //                     'username' => "2ndhandmarket1",
    //                     'password' => "JZJEKH4Z",
    //                     'number' => "$to",
    //                     'message' => "$message"
    //                 );

    //                 $ch = curl_init(); // Initialize cURL
    //                 curl_setopt($ch, CURLOPT_URL, $url);
    //                 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                 $smsresult = curl_exec($ch);
    //                 $p = explode("|", $smsresult);
    //                 $sendstatus = $p[0];
    //             } catch (\Exception $e) {
    //                 return response()->json(['error' => 'An error occurred while sending the OTP'], 500);
    //             }
    //         } else {
    //             return response()->json(['error' => 'Invalid login credentials'], 401);
    //         }

    //         if (!$user) {
    //             return response()->json(['error' => 'User not found'], 404);
    //         }

    //         try {
    //             $token = JWTAuth::fromUser($user);
    //         } catch (JWTException $e) {
    //             return response()->json(['error' => 'could_not_create_token'], 500);
    //         }

    //         return response()->json([
    //             'message' => 'Login successful!',
    //             'user' => $user,
    //             'token' => $token
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'An error occurred while trying to login'], 500);
    //     }
    // }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required_without_all:email,mobile',
            'email' => 'required_without_all:username,mobile',
            'mobile' => 'required_without_all:email,username',
            'password' => 'required_without:mobile',
            'otp' => 'required_if:mobile,exists:users,mobile',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {
            // Mobile login with OTP
            if ($request->has('mobile')) {
                if ($request->has('otp')) {
                    return $this->otpLogin($request); // Handle OTP login
                } else {
                    return $this->sendOtp($request); // Send OTP if mobile is provided
                }
            }

            // Email or Username login with password
            if ($request->has('email') && Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $user = User::where('email', $request->email)->first();
            } elseif ($request->has('username') && Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                $user = User::where('username', $request->username)->first();
            } else {
                return response()->json(['error' => 'Invalid login credentials'], 401);
            }

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
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while trying to login'], 500);
        }
    }

    public function sendOtp(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
        ]);

        $pin = rand(1111, 9999); // Generate a 4-digit OTP
        $to = $request->mobile;
        $message = "Your One time Login PIN for Classified is " . $pin . ". It will expire in 3 minutes.";

        try {
            $user_info = User::where("mobile", $to)->first();

            if (!empty($user_info)) {
                $user_info->update([
                    'password' => bcrypt($pin), // Save OTP as a hashed password
                ]);
            } else {
                User::create([
                    'mobile' => $to,
                    'password' => bcrypt($pin),
                    'status' => '1',
                    'username' => $to,
                ]);
            }

            // Send OTP via SMS
            $url = "http://139.99.39.237/api/smsapi?api_key=mPs3CslIA2tXhyrIqMip&type=text&number=Receiver&senderid=8809617613457&message=TestSMS";
            $data = array(
                'username' => "2ndhandmarket1",
                'password' => "JZJEKH4Z",
                'number' => "$to",
                'message' => "$message"
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while sending the OTP'], 500);
        }

        return response()->json(['message' => 'OTP sent successfully'], 200);
    }

    public function otpLogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
            'otp' => 'required',
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if ($user && Hash::check($request->otp, $user->password)) {
            Auth::login($user);
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Invalid OTP or mobile number'], 401);
        }
    }














    // public function otp(Request $request)
    // {
    //     $this->validate($request, [
    //         'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
    //     ]);

    //     $pin = rand(1111, 9999);

    //     $to = $request->mobile;
    //     $message = "Your One time Login PIN for Classified is " . $pin . ". It will expire in 3 minutes.";

    //     try {
    //         $user_info = User::where("mobile", $to)->first();

    //         if (!empty($user_info)) {
    //             $user_info->update([
    //                 'password' => $pin,
    //             ]);
    //         } else {
    //             $flag = User::create([
    //                 'mobile' => $to,
    //                 'password' => $pin,
    //                 'status' => '1',
    //                 'username' => $to,
    //             ]);
    //         }

    //         $url = "http://139.99.39.237/api/smsapi?api_key=mPs3CslIA2tXhyrIqMip&type=text&number=Receiver&senderid=8809617613457&message=TestSMS";
    //         $data = array(
    //             'username' => "2ndhandmarket1",
    //             'password' => "JZJEKH4Z",
    //             'number' => "$to",
    //             'message' => "$message"
    //         );

    //         $ch = curl_init(); // Initialize cURL
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         $smsresult = curl_exec($ch);
    //         $p = explode("|", $smsresult);
    //         $sendstatus = $p[0];
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'An error occurred while sending the OTP'], 500);
    //     }

    //     return view('frontend.auth.otp', $data);
    // }

    // public function otplogin(Request $request)
    // {
    //     $this->validate($request, [
    //         // 'phone_number' => 'required|regex:/[0-9]{10}/|digits:10',    
    //         'otp' => 'required',
    //     ]);

    //     $user = User::where('mobile', $request->mobile)->first();
    //     // dd($request->otp);
    //     if ($user->password == $request->otp) {
    //         Auth::login($user);
    //         $request->session()->flash('LoginSuccess', 'Login successful!');
    //         return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    //     } else {
    //         $number = $user->mobile;
    //         return view('frontend.auth.otp', ['number' => $number, 'error' => 'OTP did not match']);
    //     }
    // }


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
