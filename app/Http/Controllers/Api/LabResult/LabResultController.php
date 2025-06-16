<?php

namespace App\Http\Controllers\Api\LabResult;

use App\Http\Requests\LabResult\StoreLabResultRequest;
use App\Http\Requests\LabResult\UpdateLabResultRequest;
use App\Http\Resources\LabResult\LabResultResource;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LabResult\LabResultRepository;

class LabResultController extends Controller
{
    use HttpResponse;
    protected $labResultRepo;

    public function __construct(LabResultRepository $labResultRepo)
    {
        $this->labResultRepo = $labResultRepo;
    }
    public function index()
    {
        try {
            $labResult = $this->labResultRepo->allLabResults();
            return $this->success('success', LabResultResource::collection($labResult), 'LabResults Fetched Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function store(StoreLabResultRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $labResult = $this->labResultRepo->createLabResult($validatedData);
            $labNewResult = $this->labResultRepo->getById($labResult->id);
            return $this->success('success', LabResultResource::make($labNewResult), 'LabResult Created Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function show($labId)
    {
        try {
            $labResult = $this->labResultRepo->getById($labId);
            if (!$labResult) {
                return $this->fail('fail', null, 'LabResult not found', 404);
            }
            return $this->success('success', LabResultResource::make($labResult), 'LabResult retrived Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function update(UpdateLabResultRequest $request, $labId)
    {
        try {
            $validatedData = $request->validated();
            $labResult = $this->labResultRepo->getById($labId);
            if (!$labResult) {
                return $this->fail('fail', null, 'LabResult not found', 404);
            }
            $updatedLabResult  = $this->labResultRepo->updateLabResult($validatedData, $labResult);
            return $this->success('success', LabResultResource::make($updatedLabResult), 'LabResult Updated Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function destroy($labId)
    {
        try {
            $labResult = $this->labResultRepo->getById($labId);
            if (!$labResult) {
                return $this->fail('fail', null, 'LabResult not found', 404);
            }
            $this->labResultRepo->deleteById($labResult);
            return $this->success('success', null, 'LabResult Deleted Successfully', 204);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

}
