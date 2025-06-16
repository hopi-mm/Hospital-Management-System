<?php

namespace App\Http\Resources\LabResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'appointment_id'=>$this->appointment_id,
            'test_name'=>$this->test_name,
            'result_summary'=>$this->result_summary,
            'detailed_result'=>$this->detailed_result,
            'performed_at'=>$this->performed_at,
        ];
    }
}
