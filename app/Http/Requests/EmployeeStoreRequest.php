<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeStoreRequest extends FormRequest
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
            "name" => 'required|string|max:255',
            "email" => 'required|email|unique:employees',
            "phone_no"=>'required',
            "age"=>'required|numeric|min:18',
            "gender"=>'required|in:female,male'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors
        
    }

    public function messages(){
    return [
        'name.required' => 'The name field is required.',
        'name.string' => 'The name field must be a string.',
        'name.max' => 'The name field must not exceed 255 characters.',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'The email address is already in use.',
        'age.min'=>'the age must be above 18'
    ];
    }
}
