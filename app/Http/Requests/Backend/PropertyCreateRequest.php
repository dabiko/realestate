<?php

namespace App\Http\Requests\Backend;

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
            'name' => ['required', 'string', 'min:4', 'max:50'],
            'property_category' => ['required', 'integer'],
            'agent' => ['required', 'integer'],
            'video_link' => ['required', 'string'],
            'lowest_price' => ['required', 'integer'],
            'maximum_price' => ['required', 'integer'],
            'buy_sale_rent' => ['required', 'string'],
            'short_desc' => ['required', 'string'],
            'long_desc' => ['required', 'string'],
            'amenity' => ['required', 'string'],
            'property_tag' => ['required', 'string'],
            'status' => ['required', 'integer'],
        ];
    }
}
