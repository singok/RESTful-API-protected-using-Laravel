<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

/*------------------Register amd Login (partially protected)---------------------*/
Route::controller(UserController::class)->group(function () {
    Route::post('register', 'signup');  // user register
    Route::post('login', 'signin');     // user login
    Route::post('logout', 'signout')->middleware('auth:sanctum');   // user logout
});

/*------------------Employee (protected)----------------------*/
Route::controller(EmployeeController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('employee', 'index');            // display all employee
    Route::get('employee/{id}', 'show');        // display specific employee
    Route::post('employee', 'store');           // insert employee
    Route::put('employee/{id}', 'update');      // update employee detail
    Route::delete('employee/{id}', 'destroy');  // delete employee detail
});
/*----------------------End-----------------------*/