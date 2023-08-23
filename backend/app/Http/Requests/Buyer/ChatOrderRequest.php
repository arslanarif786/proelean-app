<?php

namespace App\Http\Requests\Buyer;

use Illuminate\Foundation\Http\FormRequest;

class ChatOrderRequest extends FormRequest
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
            'service_id'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'revision'=>['required'],
            'delivery_time'=>['required'],
            'token'=>['required'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
