<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            // Patient rules
            'name' => ['required', 'string', 'max:255'],
            'national_id' => ['required', 'string', 'unique:patients,national_id','min:14','max:14'],
            'mobile' => ['nullable', 'string','unique:patients,mobile','min:11','max:11'],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string'],
            'children_count' => ['nullable', 'integer'],
            'governorate' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ];
    }
}
