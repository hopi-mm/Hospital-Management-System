<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:50',
            'email' => 'required|unique:users,email',
            'relation' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'blood_type' => 'required',
            'phone' => 'required|max:15',
            'user_id'=>'exists:users,id',
        ];
    }

     public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'success' => false,
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ],422));
    }
}
