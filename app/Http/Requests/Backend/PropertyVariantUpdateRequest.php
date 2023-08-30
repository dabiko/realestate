<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyVariant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyVariantUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(PropertyVariant $propertyVariant): array
    {
        return [
            'name' => ['required', 'string','min:4', 'max:100',
                Rule::unique('property_variants', 'id')->ignore($propertyVariant->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
