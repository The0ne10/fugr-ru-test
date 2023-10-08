<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    const ru_number = '/(^8|7|\+7)((\d{10})|(\s\(\d{3}\)\s\d{3}\s\d{2}\s\d{2}))/';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullName' => 'nullable|string',
            'company' => 'nullable|string',
            'phone' => ['nullable', 'regex:' .self::ru_number, 'digits:11'],
            'email' => 'nullable|unique:notebooks,email',
            'birthday' => 'nullable|date',
            'image' => 'nullable|string',
        ];
    }
}
