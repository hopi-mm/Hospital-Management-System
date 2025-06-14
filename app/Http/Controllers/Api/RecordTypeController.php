<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordType\StoreRecordTypeRequest;
use App\Http\Resources\RecordType\RecordTypeResource;
use App\Models\RecordType;
use App\Repositories\RecordType\RecordTypeRepository;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class RecordTypeController extends Controller
{

    use HttpResponse;

    protected $recordTypeRepo;

    public function __construct(RecordTypeRepository $recordTypeRepository){
        $this->recordTypeRepo=$recordTypeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $recordTypes=$this->recordTypeRepo->allRecordTypes();
            return $this->success('success', RecordTypeResource::collection($recordTypes), 'Record Types Fetched Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordTypeRequest $request)
    {
        try {
            $validatedData=$request->validated();
            $recordType=$this->recordTypeRepo->createRecordType($validatedData);
            $createdRecordType=$this->recordTypeRepo->getById($recordType);
            return $this->success('success', RecordTypeResource::make($createdRecordType), 'Record Types Created Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RecordType $recordType)
    {
         try {
            $recordType=$this->recordTypeRepo->getById($recordType);
            return $this->success('success', RecordTypeResource::make($recordType), 'Record Types Showed Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRecordTypeRequest $request,RecordType $recordType)
    {
         try {
            $validatedData=$request->validated();
           $recordType=$this->recordTypeRepo->updateRecordType($validatedData,$recordType);
            $updatedRecordType=$this->recordTypeRepo->getById($recordType);
            return $this->success('success', RecordTypeResource::make($updatedRecordType), 'Record Types Updated Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecordType $recordType)
    {
          try {
           $recordType=$this->recordTypeRepo->deleteById($recordType);

            return $this->success('success',null, 'Record Types Showed Successfully', 204);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }
}
