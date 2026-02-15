<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreBlogRequest extends FormRequest
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
            'category' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            // 'published_at' => 'nullable|date',
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
            'image' => 'Each file must be a valid image.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'tags' => $this->tags ? json_encode(explode(',', $this->tags)) : null,
    //     ]);
    // }


   /**
   * Handle a failed validation attempt.
   *
   * @param \Illuminate\Contracts\Validation\Validator $validator
   * @throws \Illuminate\Validation\ValidationException
   */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            response()->json([
            'message' => 'Validation failed.',
            'errors' => $validator->errors()
            ], 422)
        );
    }
}
