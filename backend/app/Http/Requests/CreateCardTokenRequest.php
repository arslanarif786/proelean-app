<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardTokenRequest extends FormRequest
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
            'number'=>['required','size:16'],
            'exp_month'=>['required','integer','min:01','max:31'],
            'exp_year'=>['required','numeric','min:'.now()->year,'max:'.(now()->year+10)],
            'cvc'=>['required','integer','min:000','max:999'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
