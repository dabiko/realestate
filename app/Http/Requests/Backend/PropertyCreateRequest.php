<?php

namespace App\Http\Requests\Backend;

use App\Models\Property;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'image' => ['required', 'image'],
            'name' => ['required', 'string', 'min:4', 'max:50', 'unique:'.Property::class],
            'category_id' => ['required', 'integer'],
            'beds' => ['required', 'integer'],
            'bath' => ['required', 'integer'],
            'size' => ['required', 'integer'],
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
