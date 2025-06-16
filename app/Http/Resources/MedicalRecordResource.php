<?php

namespace App\Http\Resources;

use App\Http\Resources\Medicine\MedicineResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordResource extends JsonResource
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
            'record_type_id'=>$this->record_type_id,
            'record_type'=>$this->recordType->name,
            'title'=>$this->title,
            'description'=>$this->description,
            'total_medicine_price'=>$this->total_medicine_price,
            'medicines'=>MedicineResource::collection($this->whenLoaded('medicines'))
        ];
    }
}
