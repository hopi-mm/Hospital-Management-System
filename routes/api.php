<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Medicine\MedicineController;
use App\Http\Controllers\Api\DoctorDetails\DoctorDetailsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('medicines',MedicineController::class);
Route::apiResource('doctor-details', DoctorDetailsController::class);
