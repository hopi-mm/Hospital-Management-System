<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    use HttpResponse;
    protected $medicalRecordRepo;

    public function __construct(MedicalRecordRepository $medicalRecordRepo){
        $this->medicalRecordRepo=$medicalRecordRepo;
    }
    public function index(){
        try {
            $medicalRecords=$this->medicalRecordRepo->allMedicalRecords();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
