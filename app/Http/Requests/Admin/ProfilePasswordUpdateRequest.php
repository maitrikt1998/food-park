<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordUpdateRequest extends FormRequest
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
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:5', 'confirmed'],
        ];
    }

    function messages(): array
    {
        return [
            'current_password.current_password' => 'Current password is invalid',
            'current_password.required' => 'Current password is required',
            'password.required' => 'New Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
