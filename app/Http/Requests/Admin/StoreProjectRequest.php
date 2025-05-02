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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in(ProjectCategories::values())],
            'is_published' => ['required', 'boolean'],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'main_image' => ['nullable', 'mimetypes:image/jpg,image/jpeg,image/png,image/webp,image/svg+xml,image/gif,image/bmp,image/tiff,image/heif,image/heic', 'max:2048'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['mimetypes:image/jpg,image/jpeg,image/png,image/webp,image/svg+xml,image/gif,image/bmp,image/tiff,image/heif,image/heic', 'max:2048'],
        ];
    }
}
