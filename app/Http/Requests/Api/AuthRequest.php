<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        if ($this->isMethod('post') && $this->routeIs('register')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ];
        }
        if ($this->isMethod('post') && $this->routeIs('login')) {
            return [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters long',
        ];
    }
}
