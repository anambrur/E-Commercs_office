<?php

namespace App\Http\Controllers\Api;

use App\Model\Common\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    #make a function for coupons
    public function getCoupons(Request $request)
    {
        try {
            $coupons = Coupon::all();
            return $coupons;
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong while fetching coupons. Please try later.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
