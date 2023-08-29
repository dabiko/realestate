<?php

namespace App\Http\Requests\Backend;

use App\Models\Property;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyUpdateRequest extends FormRequest
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
    public function rules(Property $property): array
    {
        return [
            'image' => ['nullable', 'image'],
            'name' => ['required', 'string', 'min:4', 'max:50',
                Rule::unique('properties', 'id')->ignore($property->id)],
            'category_id' => ['required', 'integer'],
            'agent_id' => ['required', 'integer'],
            'amenity_id' => ['required', 'array'],
            'video_link' => ['nullable', 'string'],
            'low_price' => ['required', 'integer'],
            'max_price' => ['required', 'integer'],
            'purpose' => ['required', 'string'],
            'short_desc' => ['required', 'string'],
            'long_desc' => ['required', 'string'],
            'tag' => ['required', 'string'],
        ];
    }
}
