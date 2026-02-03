<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'organization' => 'required',
            'summary' => 'required',
            'description' => 'nullable|string',
            'file_path' => 'nullable|url',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:active,inactive',
            'year' => 'required|date',
            'external_links' => 'nullable|string',
            'video_url' => [
                'nullable',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/',
            ]
        ];
    }
    /**
     *
     * Custom validation fail messages
     * @return array{file_path.required: string, file_path.url: string, title.required: string, video_url.regex: string}
     */
    public function messages()
    {
        return [
            'title.required' => 'Document title is required.',
            'file_path.required' => 'Google Drive document link is required.',
            'file_path.url' => 'Please provide a valid URL for the document link.',
            'video_url.regex' => 'The video URL must be a valid YouTube or Vimeo link.',
            'images.*.image' => 'Each file must be a valid image.',
            'images.*.max' => 'Each image should not exceed 5MB in size.',
        ];
    }
     /**
      * Prepares for validation
      * @return void
      */
    protected function prepareForValidation()
    {
        $this->merge([
        'external_links' => $this->external_links ? json_encode(explode(',', $this->external_links)) : null,
        ]);
    }
}
