<?php

namespace App\Http\Controllers\Api\DoctorDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Repositories\DoctorDetails\DoctorDetailsRepository;
use App\Http\Requests\DoctorDetails\StoreDoctorDetailsRequest;
use App\Http\Requests\DoctorDetails\UpdateDoctorDetailsRequest;
use App\Http\Resources\DoctorDetails\DoctorDetailsResource;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorDetail;

class DoctorDetailsController extends Controller
{

    use HttpResponse;
    protected $doctorDetailsRepo;

    public function __construct(DoctorDetailsRepository $doctorDetailsRepo)
    {
        $this->doctorDetailsRepo = $doctorDetailsRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $doctorDetails = $this->doctorDetailsRepo->getDoctorDetails();
            return $this->success('success', DoctorDetailsResource::collection($doctorDetails), 'Doctor details get success!', 201);
        }catch(\Exception $e){
             return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorDetailsRequest $request)
    {
        DB::beginTransaction();
        try{
            // To create user account
            $validation = $request->toArray();
            $user = $this->doctorDetailsRepo->createUser($validation);

            // Get user_id from created user
            $validation['user_id'] = $user->id;
            // $user->assignRole(Role::findByName('doctor', 'api'));

            // Create doctor details
            $doctorDetails = $this->doctorDetailsRepo->createDoctorDetails($validation);
            DB::commit();
            return $this->success('success', ['doctor_details' => DoctorDetailsResource::make($doctorDetails)], 'doctor details create success!', 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $doctorDetails = $this->doctorDetailsRepo->getById($id);
            return $this->success('success', DoctorDetailsResource::make($doctorDetails), 'Doctor details get by id success!', 201);
        }catch(\Exception $e){
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorDetailsRequest $request, $id)
    {
        try{
            $validation = $request->validated();
            $doctorDetails = $this->doctorDetailsRepo->getById($id);
            if(!$doctorDetails){
                return $this->fail('fail', null, 'Doctor details not found!', 404);
            }
            $updatedoctorDetails = $this->doctorDetailsRepo->updateDoctorDetails($validation, $doctorDetails);
            return $this->success('success', DoctorDetailsResource::make($updatedoctorDetails), 'Doctor details update success!', 201);
        }catch(\Exception $e){
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $doctorDetails = $this->doctorDetailsRepo->getById($id);
            if(!$doctorDetails){
                return $this->fail('fail', null, 'Doctor details not found!', 404);
            }
            $this->doctorDetailsRepo->deleteById($doctorDetails);
            return $this->success('success', null, 'Doctor details delete success!', 201);
        }catch(\Exception $e){
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }
}
