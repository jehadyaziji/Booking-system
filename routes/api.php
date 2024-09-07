<?php

use App\Http\Controllers\Admin\BusinessesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\Business\ServicesController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login' ,[AuthController::class , 'login']);
Route::post('Register' , [AuthController::class , 'register']);
Route::middleware('admin')->group(function(){
    Route::apiResource('users' , UsersController::class)->name('index' , 'users');
    Route::apiResource('businesses' , BusinessesController::class)->name('index' , 'business');

});

Route::post('admin_login', AdminLoginController::class , 'login')->name('admin_login');
Route::get('showLoginInform', AdminLoginController::class , 'showLoginInform')->name('login_form');
Route::post('logout', AdminLoginController::class , 'logout')->name('logout');

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('services' , ServicesController::class);
    Route::apiResource('bookings' , BookingsController::class);
    Route::apiResource('reviews' , ReviewsController::class);
});

Route::get('business_review/{id}' , [ReviewsController::class , 'business_review']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

