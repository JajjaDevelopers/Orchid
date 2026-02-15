<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriberRequest extends FormRequest
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
        // Retrieve the subscriber ID from the route
        $subscriberId = $this->route('id');

        return [
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers', 'email')->ignore($subscriberId),
            ],
            'name' => 'nullable|string|max:255',
            'status' => 'nullable',
        ];
    }
}
