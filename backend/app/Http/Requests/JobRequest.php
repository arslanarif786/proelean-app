<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'category_id'=>['required','min:1'],
            'sub_category_id'=>['required','min:1'],
            'description'=>['required','min:15','string'],
            'budget'=>['required','numeric','min:1'],
            'delivery_time'=>['required','string','min:1'],
            'cinic'=>['mimes:png,jpg,jpeg,zip,pdf,doc'],
            'lat'=>['numeric','min:1'],
            'lng'=>['numeric','min:1'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
