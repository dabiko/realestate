<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyFacilityItem;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyFacilityItemUpdateRequest extends FormRequest
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
    public function rules(PropertyFacilityItem $propertyFacilityItem): array
    {
        return [
            'property_id' => ['required', 'string'],
            'property_facility_id' => ['required', 'string'],
            'name' => ['required', 'string',  Rule::unique('property_facility_items', 'id')->ignore($propertyFacilityItem->id)],
            'distance' => ['required', 'string'],
            'rating' =>   ['required', 'string'],
            'status' =>   ['required', 'integer'],
        ];
    }
}
