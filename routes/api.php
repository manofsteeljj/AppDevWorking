<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TradieController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tradies', TradieController::class);
});


// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected route: Requires authentication via Sanctum token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// Public test route to check if API is working
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
