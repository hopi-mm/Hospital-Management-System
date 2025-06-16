<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecord\StoreMedicalRecordRequest;
use App\Http\Resources\MedicalRecordResource;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
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
            return $this->success('success',MedicalRecordResource::collection($medicalRecords),'Medical Records Fetched Successfully',200);
        } catch (\Exception $e) {
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    public function store(StoreMedicalRecordRequest $request){
         DB::beginTransaction();
        try {
            $validatedData=$request->validated();
            $medicalRecord=$this->medicalRecordRepo->createMedicalRecord($validatedData);
            $createdMedicalRecord=$this->medicalRecordRepo->getById($medicalRecord);
             DB::commit();
            return $this->success('success',MedicalRecordResource::make($createdMedicalRecord),'Medical Record Created Successfully',201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    public function show(MedicalRecord $medicalRecord){
        try {
           $medicalRecord=$this->medicalRecordRepo->getById($medicalRecord);
           return $this->success('success',MedicalRecordResource::make($medicalRecord),'Medical Record Fetched Successfully',200);
        } catch (\Exception $e) {
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    public function update(StoreMedicalRecordRequest $request , MedicalRecord $medicalRecord){
        DB::beginTransaction();
        try {
            $validatedData=$request->validated();
            $medicalRecord=$this->medicalRecordRepo->updateMedicalRecord($validatedData,$medicalRecord);
            $updatedMedicalRecord=$this->medicalRecordRepo->getById($medicalRecord);
            DB::commit();
            return $this->success('success',MedicalRecordResource::make($updatedMedicalRecord),'Medical Record Updated Successfully',200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    public function destroy(MedicalRecord $medicalRecord){
        try {
            $medicalRecord=$this->medicalRecordRepo->deleteById($medicalRecord);
            return $this->success('success',null,'Medical Record Deleted Successfully',204);
        } catch (\Exception $e) {
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }
}
