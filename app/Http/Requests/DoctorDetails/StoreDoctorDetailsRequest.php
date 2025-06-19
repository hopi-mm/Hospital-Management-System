<?php

namespace App\Http\Requests\DoctorDetails;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\HttpResponse;

class StoreDoctorDetailsRequest extends FormRequest
{
    use HttpResponse;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'gender' => 'required|string',
            'profile' => 'required|string|max:255',

            'speciality' => 'json',
            'experience' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'availability' => 'required|array',
            'availability.Mon' => 'array',
            'availability.Tue' => 'array',
            'availability.Wed' => 'array',
            'availability.Thu' => 'array',
            'availability.Fri' => 'array',
            'availability.*.*' => 'string|regex:/^\d{2}:\d{2}$/'
        ];
    }

}
