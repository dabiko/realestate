<?php

namespace App\Http\Requests\Admin;

use App\Models\PropertyCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyCategoryRequest extends FormRequest
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
            'icon' => ['required', 'string', 'min:4', 'max:10'],
            'name' => ['required', 'string', 'min:4', 'max:100', 'unique:'.PropertyCategory::class],
            'status' => ['required', 'boolean'],
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
            'name.unique' => ':input category is already existing',
        ];
    }
}
