<?php

namespace App\Http\Requests\Auth;

use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use HttpResponse;
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
            "email" => "required|email",
            "password" => "required",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new \HttpResponseException($this->fail('failed validation', $validator->errors(), 'Validation Error', 422));
    }
}
