<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    // В запросах где нужно валидировать почту - ставим validateEmail = true;
    public bool $validateEmail = false;
    public function rules(): array
    {
        // validator rules
        // email - required/unique
        // username - required/only latin letters
        // name - non - required/string
        $rules = [
            'username' => 'required|regex:/^[A-Za-z]+$/|unique:users',
            'name' => 'nullable|string',
        ];

        if ($this->validateEmail) {
            $rules['email'] = 'required|email|unique:users';
        }

        return $rules;
    }
}
