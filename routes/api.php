<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

Route::resource('/departments', DepartmentController::class);
Route::resource('/employees', EmployeeController::class);
Route::get('/employeesall', [EmployeeController::class, 'all']);
Route::get('/employeesbydepartment', [EmployeeController::class, 'EmployeesByDepartment']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

