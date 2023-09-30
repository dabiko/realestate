<?php

namespace App\Http\Requests\Backend;

use App\Models\BlogPost;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:4', 'max:50', 'unique:'.BlogPost::class],
            'blog_category_id' => ['required', 'integer'],
            'tags' => ['required'],
            'short_desc' => ['required', 'string'],
            'long_desc' => ['required', 'string'],
            'status' => ['required', 'boolean'],

        ];
    }
}
