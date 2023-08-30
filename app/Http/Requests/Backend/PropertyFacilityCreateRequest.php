<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyFacility;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyFacilityCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4', 'max:50', 'unique:'.PropertyFacility::class],
            'property_id' => ['required', 'string'],
            'facility' => ['required', 'string'],
            'distance' => ['required', 'string'],
            'rating' =>   ['nullable', 'string'],
            'status' =>   ['nullable', 'integer'],
        ];
    }
}
