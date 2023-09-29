<?php

namespace App\Http\Requests\Backend;

use App\Models\State;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateUpdateRequest extends FormRequest
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
    public function rules(State $state): array
    {
        return [
            'image' => ['nullable', 'image'],
            'name' => ['required', 'string', 'min:2',
                Rule::unique('states', 'id')->ignore($state->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
