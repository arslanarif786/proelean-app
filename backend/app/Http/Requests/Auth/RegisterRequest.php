<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'=>['required','min:5','regex:/^[a-zA-Z_.]+$/u','unique:users,username'],
            'name'=>['required','min:4'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:6','confirmed'],
        ];
    }
    

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
