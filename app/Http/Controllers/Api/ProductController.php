<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\Common\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function getPopularProducts(Request $request)
    {
        try {
            $popularProducts = Product::where('status', 1)
                ->orderBy('views', 'desc')
                ->paginate(10);

            return response()->json($popularProducts, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong while fetching popular products.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
