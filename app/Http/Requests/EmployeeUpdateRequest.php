<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeUpdateRequest extends FormRequest
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
            "name" => 'string|max:255',
            "email" => 'email|unique:employees',
            "age"=>'numeric|min:18',
            "gender"=>'in:female,male'
        ];
    }
    public function messages(){
            return [
                'name.string' => 'The name field must be a string.',
                'name.max' => 'The name field must not exceed 255 characters.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'The email address is already in use.',
                'age.min'=>'the age must be above 18'
            ];
    }
    protected function failedValidation(Validator $validator){
            $errors = $validator->errors();

            $response = response()->json([
                'message' => 'Invalid data send',
                'details' => $errors->messages(),
                ], 422);

            throw new HttpResponseException($response);
    }
}