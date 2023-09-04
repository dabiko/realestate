<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyAmenity;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyAmenityUpdateRequest extends FormRequest
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
    public function rules(PropertyAmenity $propertyAmenity): array
    {
        return [
            'property_id' => ['required', 'string' ],
            'amenity_id' => ['required', 'array', Rule::unique('property_amenity', 'id')->ignore($propertyAmenity->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
