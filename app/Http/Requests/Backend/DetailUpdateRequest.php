<?php

namespace App\Http\Requests\Backend;

use App\Models\Detail;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DetailUpdateRequest extends FormRequest
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
    public function rules(Detail $detail): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:100',
                Rule::unique('details', 'id')->ignore($detail->id)],
            'status' => ['required', 'boolean'],
        ];
    }
}
