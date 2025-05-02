<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProjectCategories;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:projects,title'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in(ProjectCategories::values())],
            'is_published' => ['required', 'boolean'],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'main_image' => ['nullable', 'image', 'image:allow_svg', 'max:2048'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:2048'],
        ];
    }
}
