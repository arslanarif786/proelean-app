<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Validation\Rules\Iban;

class AddBankAccountRequest extends FormRequest
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
            'iban' => ['required', new Iban],
            'bank_name' => 'required',
            'bank_title' => 'required'
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
