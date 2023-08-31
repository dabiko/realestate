<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyDetail;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyDetailUpdateRequest extends FormRequest
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
    public function rules(PropertyDetail $propertyDetail): array
    {
        return [
            'detail_id' => ['required', 'string',  Rule::unique('property_details', 'id')->ignore($propertyDetail->id)],
            'property_id' => ['required', 'string'],
            'value' => ['required', 'string'],
            'status' => ['required', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
//            'detail_id.rule' => 'This name is already existing. You can only modify for now',
            'detail_id.required' => 'Name is a required field',
        ];
    }
}
