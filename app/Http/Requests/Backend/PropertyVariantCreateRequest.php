<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyVariant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyVariantCreateRequest extends FormRequest
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
            'property_id' => ['required', 'string'],
            'name' => ['required', 'string','min:4', 'max:100', 'unique:'.PropertyVariant::class],
            'status' => ['required', 'boolean'],
        ];
    }
}
