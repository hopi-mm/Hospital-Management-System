<?php

namespace App\Repositories\LabResult;

use App\Models\LabResult;

class LabResultRepository
{

    public function allLabResults()
    {
        return LabResult::all();
    }

    public function createLabResult($data)
    {
        return LabResult::create($data);
    }

    public function getById($labId)
    {
        $labResult = LabResult::where('id', $labId)->first();
        return $labResult;
    }

    public function updateLabResult($data, $labResult)
    {   
        $labResult->update($data);
        return $labResult;
    }

    public function deleteById(LabResult $labResult)
    {
        $labResult->delete();
        return $labResult;
    }
}
