<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitRequest extends FormRequest
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
            'patient_id' => ['nullable', 'exists:patients,id'],
            'problem' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'visit_date' => ['nullable', 'date'],
        ];
    }
}
