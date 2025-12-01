<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicineModule\Http\Controllers\MedicineModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medicinemodules', MedicineModuleController::class)->names('medicinemodule');
});
