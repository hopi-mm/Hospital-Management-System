<?php

namespace App\Http\Resources\DoctorDetails;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorDetailsResource extends JsonResource
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
            'user_id' => $this->user_id,
            'speciality' => $this->speciality,
            'experience' => $this->experience,
            'education' => $this->education,
            'license_number' => $this->license_number,
            'availability' => $this->availability
        ];
    }
}
