<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SslCommerzPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END




Route::group(["namespace" => "Api\Auth"], function () {
    Route::post("login", "ApiAuthController@Login")->name("login");
    Route::post('register', "RegisterController@register")->name("register");
    Route::post('logout', "ApiAuthController@logout")->middleware('auth:api');
    Route::post('forgotPassword', "PasswordResetController@forgotPassword")->name("forgotPassword");
    Route::post('resetPassword', "PasswordResetController@resetPassword")->name("resetPassword");

    // Route::get('me', "ApiAuthController@Login")->middleware('auth:api');
});


Route::group(["middleware" => ["auth:api", "jwt.auth"], "namespace" => "Api"], function () {
    Route::get("get-category", "CategoryController@getCategory")->name("get-category");
    Route::get("category-wise-product/{category_id}", "CategoryController@categoryWiseProduct")->name("category-wise-product");

    Route::get("get-brands", "BrandController@getBrands")->name("get-brands");
    Route::get("brand-wise-product/{brand_id}", "BrandController@brandWiseProduct")->name("brand-wise-product");

    Route::get("get-popular-products", "ProductController@getPopularProducts")->name("get-popular-products");
    Route::get("get-latest-products", "ProductController@getLatestProducts")->name("get-latest-products");
    Route::get("get-best-selling-products", "ProductController@getBestSellingProducts")->name("get-best-selling-products");
    Route::get("get-slider", "ProductController@getSlider")->name("get-slider");
    Route::get("product-details/{product_id}", "ProductController@productDetails")->name("product-details");
    Route::post("product-filter", "ProductController@productFilter")->name("product-filter");
    Route::post("product-search", "ProductController@productSearch")->name("product-search");
    Route::post("search-suggestions", "ProductController@searchSuggestions")->name("search-suggestions");
    Route::post("add-product-review", "ProductController@addProductReview")->name("add-product-review");
    Route::post("get-product-reviews", "ProductController@getProductReviews")->name("get-product-reviews");
    Route::post("add-to-cart", "CartController@addToCart")->name("add-to-cart");
    Route::post("get-cart-contents", "CartController@getCartContents")->name("get-cart-contents");

    Route::get("get-profile", "ProfileController@getProfile")->name("get-profile");
    Route::post("update-profile", "ProfileController@updateProfile")->name("update-profile");
});







// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
