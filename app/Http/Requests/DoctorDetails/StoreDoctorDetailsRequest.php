<?php

namespace App\Http\Requests\DoctorDetails;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorDetailsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'speciality' => 'required|string|max:255',
            'experience' => 'required',
            'education' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'availability' => 'array',
            'availability.Mon' => 'array',
            'availability.Tue' => 'array',
            'availability.Wed' => 'array',
            'availability.Thu' => 'array',
            'availability.Fri' => 'array',
            'availability.*.*' => 'string|regex:/^\d{2}:\d{2}$/'
        ];
    }
}
