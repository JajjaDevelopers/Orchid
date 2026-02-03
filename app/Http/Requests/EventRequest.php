<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class EventRequest extends FormRequest
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
    public function rules()
    {
        return [
        'title' => 'required|string|max:255',
        'description' => 'required|max:700',
        'location' => 'required|string|max:255',
        'date' => 'required|date',
        'start_time'=>'required',
        'end_time'=>'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2024',
        'scripture_reference' => 'nullable|string|max:255',
        ];
    }

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
