<?php

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecordTypeController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\Medicine\MedicineController;
use App\Http\Controllers\Api\LabResult\LabResultController;
use App\Http\Controllers\Api\Appointment\AppointmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('medicines', MedicineController::class);
    Route::apiResource('record-types', RecordTypeController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::apiResource('lab-results', LabResultController::class);
<<<<<<< HEAD
    Route::apiResource('appointments', AppointmentController::class);
=======
    Route::apiResource('patient',PatientController::class);
>>>>>>> f946124991eee1af08418c41f7cc4ac07a089e9d
});
  