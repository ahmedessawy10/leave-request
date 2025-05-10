<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaveRequestController;
use App\Http\Controllers\Api\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware("auth:sanctum")->group(function () {

    Route::post("/profile", [ProfileController::class, 'updateProfile']);
    Route::get("/profile", [ProfileController::class, 'getProfile']);
    Route::get('/request/leave/allreviews', [LeaveRequestController::class, 'showAllReviews']);
    Route::post('/request/leave/review/{id}', [LeaveRequestController::class, 'reviewRequest']);
    Route::post('/request/leave/hr/', [LeaveRequestController::class, 'showRequestForHr']);

    Route::resource('request/leave', LeaveRequestController::class);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgetpassword', [AuthController::class, 'forgot_password']);
Route::post('/resetpassword', [AuthController::class, 'reset_password']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');


Route::post('/forgot-password', [AuthController::class, "forgot_password"])->middleware('guest')->name('password.email');
