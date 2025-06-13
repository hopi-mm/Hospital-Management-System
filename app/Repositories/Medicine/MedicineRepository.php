<?php

namespace App\Http\Repositories\Medicine;

use App\Models\Medicine;

class MedicineRepository{

    public function allMedicines(){
        return Medicine::all();
    }

    public function createMedicine($data){
        return Medicine::create($data);
    }

    public function getById(Medicine $medicine){
        return $medicine;
    }

    public function updateMedicine($data,$medicine){
        $medicine->update($data);
        return $medicine;
    }

    public function deleteById(Medicine $medicine){
        $medicine->delete();
        return $medicine;
    }
}
