<?php

namespace App\Http\Requests\Backend;

use App\Models\Facility;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacilityUpdateRequest extends FormRequest
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
    public function rules(Facility $facility): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:100',
                Rule::unique('facilities', 'id')->ignore($facility->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
