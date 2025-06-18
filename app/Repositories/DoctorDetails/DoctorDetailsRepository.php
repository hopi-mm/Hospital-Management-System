<?php

namespace App\Http\Repositories\DoctorDetailsRepository;

use App\Models\DoctorDetail;

class DoctorDetailsRepository{
    // public function getUser(){
    //     return User::all();
    // }

    public function createDoctorDetails($data){
        return DoctorDetail::create($data);
    }

    public function getById(DoctorDetail $doctorDetails){
        return $doctorDetails;
    }

    public function updateDoctorDetails($data, $doctorDetails){
        $doctorDetails->update($data);
        return $doctorDetails;
    }

    public function deleteById(createDoctorDetails $doctorDetails){
        $doctorDetails->delete();
        return $doctorDetails;
    }
}