<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyFacility;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyFacilityUpdateRequest extends FormRequest
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
    public function rules(PropertyFacility $propertyFacility): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:50', Rule::unique('property_facilities', 'id')->ignore($propertyFacility->id)],
            'property_id' => ['required', 'string'],
            'facility' => ['required', 'string'],
            'distance' => ['required', 'string'],
            'rating' =>   ['required', 'string'],
            'status' =>   ['required', 'integer'],
        ];
    }
}
