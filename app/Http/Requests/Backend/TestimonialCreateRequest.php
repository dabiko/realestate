<?php

namespace App\Http\Requests\Backend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialCreateRequest extends FormRequest
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
            'position' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:2'],
            'name' => ['required', 'string', 'min:2'],
            'message' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}
