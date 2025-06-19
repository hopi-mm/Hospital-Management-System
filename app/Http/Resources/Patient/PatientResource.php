<?php

namespace App\Http\Resources\Patient;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'relation' => $this->relation,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'blood_type' => $this->blood_type,
            'phone' => $this->phone
        ];
    }
}
