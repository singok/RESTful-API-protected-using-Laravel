<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

/*------------------Register amd Login (public)---------------------*/
Route::controller(UserController::class)->group(function () {
    Route::post('register', 'signup');
    Route::post('login', 'signin');
});

/*------------------Employee (protected)----------------------*/
Route::controller(EmployeeController::class)->middleware('auth:sanctum')->group(function () {

});
/*----------------------End-----------------------*/