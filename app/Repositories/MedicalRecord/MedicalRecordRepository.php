<?php

namespace App\Repositories\MedicalRecord;

use App\Models\MedicalRecord;

class MedicalRecordRepository{


    public function allMedicalRecords(){
        return MedicalRecord::all();
    }
}
