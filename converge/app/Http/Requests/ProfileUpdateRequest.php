<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // VALIDATION RULES - Define what data is allowed for profile updates
    public function rules(): array
    {
        return [
            // USERNAME VALIDATION - Must be unique, required, string, max 255 chars
            'username' => [
                'required',
                'string', 
                'max:255',
                // UNIQUE CHECK - Username must be unique except for current user
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // DISPLAY NAME VALIDATION - Required string field, max 255 characters  
            'display_name' => ['required', 'string', 'max:255'],
            // EMAIL VALIDATION - Required, unique, valid email format
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // UNIQUE CHECK - Email must be unique except for current user
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // BIO VALIDATION - Optional text field, max 500 characters
            'bio' => ['nullable', 'string', 'max:500'],
        ];
    }
}
