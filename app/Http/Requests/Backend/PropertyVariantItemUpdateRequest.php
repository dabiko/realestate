<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyVariantItem;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyVariantItemUpdateRequest extends FormRequest
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
    public function rules(PropertyVariantItem $propertyVariantItem): array
    {
        return [
            'name' => ['required', 'string','min:4', 'max:100',
                Rule::unique('property_variant_items', 'id')->ignore($propertyVariantItem->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
