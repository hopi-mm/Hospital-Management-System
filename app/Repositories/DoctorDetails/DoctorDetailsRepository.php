<?php

namespace App\Repositories\DoctorDetails;

use App\Models\DoctorDetail;
use App\Models\User;

class DoctorDetailsRepository{
    public function createUser($data){
        return User::create($data);
    }

    public function getDoctorDetails(){
        return DoctorDetail::all();
    }

    public function createDoctorDetails($data){
        return DoctorDetail::create($data);
    }

    public function getById($id){
        $doctorDetails = DoctorDetail::where('id', $id)->first();
        return $doctorDetails;
    }

    public function updateDoctorDetails($id, $doctorDetails){
        $doctorDetails->update($id);
        return $doctorDetails;
    }

    public function deleteById(DoctorDetail $doctorDetails){
        $doctorDetails->delete();
        return $doctorDetails;
    }
}
