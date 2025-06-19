<?php

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecordTypeController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\Medicine\MedicineController;
use App\Http\Controllers\Api\DoctorDetails\DoctorDetailsController;
use App\Http\Controllers\Api\LabResult\LabResultController;
use App\Http\Controllers\Api\Appointment\AppointmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('medicines',MedicineController::class);

Route::prefix('v1')->group(function () {
    Route::apiResource('medicines', MedicineController::class);
    Route::apiResource('record-types', RecordTypeController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::apiResource('lab-results', LabResultController::class);
    Route::apiResource('doctors', DoctorDetailsController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('patient',PatientController::class);
});
