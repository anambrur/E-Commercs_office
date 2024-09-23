<?php

use Illuminate\Http\Request;

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




Route::group(["namespace" => "Api\Auth"], function () {
    Route::post("login", "ApiAuthController@Login")->name("login");
    Route::post('register', "RegisterController@register")->name("register");
    Route::post('logout', "ApiAuthController@logout")->middleware('auth:api');
    Route::post('forgotPassword', "PasswordResetController@forgotPassword")->name("forgotPassword");
    Route::post('resetPassword', "PasswordResetController@resetPassword")->name("resetPassword");

    // Route::get('me', "ApiAuthController@Login")->middleware('auth:api');
});


Route::group(["middleware" => "auth:api", "namespace" => "Api"], function () {
    Route::get("getCategory", "CategoryController@getCategory")->name("getCategory");
    Route::get("categoryWiseProduct/{category_id}", "CategoryController@categoryWiseProduct")->name("categoryWiseProduct");
    
    Route::get("getBrands", "BrandController@getBrands")->name("getBrands");
    Route::get("brandWiseProduct/{brand_id}", "BrandController@brandWiseProduct")->name("brandWiseProduct");

    Route::get("getPopularProducts", "ProductController@getPopularProducts")->name("getPopularProducts");
});







// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
