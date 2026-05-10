<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $patientId = $this->route('patient');
        return [
            'name' => ['nullable', 'string', 'max:255'],

            'national_id' => [
                'nullable',
                'string',
                Rule::unique('patients', 'national_id')->ignore($patientId),
            ],
            'mobile' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string'],
            'children_count' => ['nullable', 'integer'],
            'governorate' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ];
    }
}
