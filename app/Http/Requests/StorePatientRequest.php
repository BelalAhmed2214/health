<?php

namespace App\Http\Requests;

use App\Enums\SectionEnum;
use App\Enums\SourceOfMoneyEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $followers = array_keys(\App\Models\Patient::followers());
        return [
            'name'           => ['required', 'string', 'max:255'],
            'national_id'    => ['required', 'string', 'unique:patients,national_id', 'min:14', 'max:14'],
            'mobile'         => ['nullable', 'string', 'unique:patients,mobile', 'min:11', 'max:11'],
            'date_of_birth'  => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string'],
            'children_count' => ['nullable', 'integer'],
            'governorate'    => ['nullable', 'string'],
            'address'        => ['nullable', 'string'],
            'problem'        => ['nullable', 'string'],
            'solution'       => ['nullable', 'string'],
            'notes'          => ['nullable', 'array'],
            'notes.*'        => ['nullable', 'string'],
            'visit_date'     => ['nullable', 'date'],
            'price'          => ['nullable', 'numeric', 'min:0'],
            'follower'       => ['nullable', 'string', Rule::in($followers)],
            'section'         => ['nullable', Rule::enum(SectionEnum::class)],
            'source_of_money' => ['nullable', Rule::enum(SourceOfMoneyEnum::class)],
        ];
    }
}
