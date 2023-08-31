<?php

namespace App\Http\Requests\Backend;

use App\Models\PropertyDetail;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyDetailCreateRequest extends FormRequest
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
            'detail_id' => ['required', 'integer', 'unique:'.PropertyDetail::class],
            'property_id' => ['required', 'string'],
            'value' => ['required', 'string'],
            'status' => ['required', 'integer'],
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
            'detail_id.unique' => 'This name is already existing. You can only modify for now',
            'detail_id.required' => 'Name is a required field',
        ];
    }
}
