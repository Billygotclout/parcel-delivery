<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'token'=> 'required',
           'email' => ['required', 'string', 'email'],
           'password' => [
            'required',
            'confirmed',
            Password::min(6)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised(),
        ]

        ];
    }
}
