<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/departaments', DepartamentController::class);
Route::resource('/employee', EmployeeController::class);
Route::get('/employeesall', [EmployeeController::class, 'all']);
Route::get('/employeesbydepartament', [EmployeeController::class, 'EmployeesByDepartament']);