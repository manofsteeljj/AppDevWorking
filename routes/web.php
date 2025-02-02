<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarDesignController;

Route::resource('car_designs', CarDesignController::class);

Route::get('/', function () {
    return view('welcome');
});
