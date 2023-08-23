<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'token' => ['required', 'min:6'],
            "email"=>['required', 'email', 'exists:users'],
            'password' => ['min:6', 'string', 'confirmed'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
