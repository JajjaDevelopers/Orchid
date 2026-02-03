<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'country_code'=>'nullable',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'ip_address' => 'nullable|ip',
        ];
    }

    /**
     * Prepare data for validation
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'ip_address' => $this->ip(),
        ]);
    }

    /**
     * Custom error messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'subject.required' => 'The subject field is required.',
            'message.required' => 'The message field is required.',
        ];
    }
}
