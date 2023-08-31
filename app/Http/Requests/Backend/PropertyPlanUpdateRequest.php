<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyPlan;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyPlanUpdateRequest extends FormRequest
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
    public function rules(PropertyPlan $propertyPlan): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('property_plans', 'id')->ignore($propertyPlan->id)],
            'property_id' => ['required', 'string',],
            'image' => ['nullable', 'image',],
            'short_desc' => ['required', 'string'],
            'status' => ['required', 'integer'],
        ];
    }
}
