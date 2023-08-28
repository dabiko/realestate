<?php

namespace App\Http\Requests\Backend;

use App\Models\Amenity;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAmenityRequest extends FormRequest
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
    public function rules(Amenity $amenity): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:100',
                Rule::unique('amenities', 'id')->ignore($amenity->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
