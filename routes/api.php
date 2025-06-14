<?php

use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\RecordTypeController;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Medicine\MedicineController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    Route::apiResource('medicines',MedicineController::class);
    Route::apiResource('record-types',RecordTypeController::class);
    Route::apiResource('medical-records',MedicalRecordController::class);

});
