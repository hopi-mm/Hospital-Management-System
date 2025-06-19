<?php

namespace App\Repositories\Patient;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientRepository{

    public function allPatient(){
        return Patient::all();
    }

    public function createPatient($data){
        return Patient::create($data);
    }

    public function getByID(Patient $patient){
        return $patient;
    }

    public function updatePatient($data,$patient){
        $patient->update($data);
        return $patient;
    }

    public function deletePatient(Patient $patient){
        $patient->delete();
        return $patient;
    }

     public function createUser($data){
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
    ]);
    return $user;
    }


}
