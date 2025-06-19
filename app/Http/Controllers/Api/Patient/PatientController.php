<?php

namespace App\Http\Controllers\Api\Patient;

use Exception;
use App\Models\Patient;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Patient\PatientResource;
use App\Repositories\Patient\PatientRepository;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;

class PatientController extends Controller
{

    use HttpResponse;

    protected $patientRepo;

    public function __construct(PatientRepository $patientRepo){
        return $this->patientRepo = $patientRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allpatient = $this->patientRepo->allPatient();
            return $this->success('success', PatientResource::collection($allpatient),'Patient Fetched Successfully!',200);
        }catch(\Exception $e){
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        DB::beginTransaction();
        try{

            $validationData = $request->toArray();
            $user = $this->patientRepo->createUser($validationData);
            if(!$user){
                throw new \Exception('User Creation Failed');
            }

            $validationData['user_id'] = $user->id;
            $user->assignRole(Role::findByName('patient','api'));


            $patient = $this->patientRepo->createPatient($validationData);
            $storePatient = $this->patientRepo->getByID($patient);
            DB::commit();
            return $this->success("success", PatientResource::make($storePatient),'Patient Created Successfully!',200);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        try{
            $showPatient = $this->patientRepo->getByID($patient);
            return $this->success('success', PatientResource::make($showPatient),'Patient Showed Successfully!',200);
        }catch(\Exception $e){
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        try{
            $validation_data = $request->validate([
                'name' => 'required|min:2|max:50',
                "email" => 'required|unique:users,email',
                'relation' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'blood_type' => 'required',
                'phone' => 'required|max:15',
                'user_id'=>'exists:users,id',
            ]);
            $PATIENT = $this->patientRepo->updatePatient($validation_data,$patient);
            $updatePatient = $this->patientRepo->getByID($PATIENT);
            return $this->success('success', PatientResource::make($updatePatient),'Patient Updated Successfully!',200);
        }catch(\Exception $e){
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try{
            $deletePatient = $this->patientRepo->deletePatient($patient);
        return $this->success('success',null, 'Patient Deleted Successfully!',200);
        }catch(\Exception $e){
            return $this->fail('error',null,$e->getMessage(),500);
        }
    }
}
