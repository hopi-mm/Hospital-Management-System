<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicineModule\Http\Controllers\MedicineModuleController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicinemodules', MedicineModuleController::class)->names('medicinemodule');
});
