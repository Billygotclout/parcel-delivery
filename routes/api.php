<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Rides\RidesController;
use App\Http\Controllers\Shipping\ShippingItemsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/get-phone-number', [RegisterController::class, 'getPhoneNumber']);
    Route::post('/verify-code', [RegisterController::class, 'verifyCode']);
    Route::post('/resend-code', [RegisterController::class, 'resendCode']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});



Route::group(['middleware' => ['auth:sanctum']], function () {
  

    Route::group(['prefix' => 'rides'], function () {
        Route::post('/save-rides', [RidesController::class, 'rides']);
        Route::get('/ride-history', [RidesController::class, 'rideHistory']);
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('verify-transaction', [PaymentController::class, 'verifyTransaction']);
        Route::get('get-card-details', [PaymentController::class, 'getCardDetails']);
    });
    Route::group(['prefix' => 'shipping'], function () {
        Route::post('/shipping-items', [ShippingItemsController::class, 'itemsDetails']);
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('user-details', [ProfileController::class, 'getUserDetails']);
       Route::post('add-profile-picture', [ProfileController::class, 'addProfilePicture']);
    });
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [LogoutController::class, 'logout']);
});
