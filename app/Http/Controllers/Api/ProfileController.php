<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function getProfile()
    { 
        return response()->json([
            'status' => 'success',
            'user' => auth()->user(),
        ], 200);
    }
}
