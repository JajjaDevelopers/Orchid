<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:400',
            'status' => 'required|in:draft,published',
            'tags' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'delete_images' => 'array|nullable',
            'delete_images.*' => 'string|url',
        ];
    }

     /**
     * Get custom error messages for validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
        'title.required' => 'The blog title is required.',
        'content.required' => 'The blog content is required.',
        'images.*.image' => 'Each file must be a valid image.',
        'images.*.max' => 'Each image should not exceed 5MB in size.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'tags' => $this->tags ? json_encode(explode(',', $this->tags)) : null,
        ]);
    }
}
