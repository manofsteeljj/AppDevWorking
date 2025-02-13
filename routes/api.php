<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::middleware([
    EnsureFrontendRequestsAreStateful::class, 
    'throttle:api'
])->group(function () {
    // Protected route: Requires authentication via Sanctum token
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

// Public route to check if API is working
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Login route for Sanctum authentication
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken('API Token')->plainTextToken,
    ]);
});

// Logout route to revoke the user's tokens
Route::post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully']);
})->middleware('auth:sanctum');
