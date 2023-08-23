<?php

namespace App\Http\Requests\Seller;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class SendOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $serviceUserID=Service::findOrFail(customDecrypt(request()->service_id))->user_id;
        return auth()->id()==$serviceUserID;
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
            'job_id'=>['required'],
            'description'=>['required','min:5'],
            'price'=>['required','min:1'],
            'delivery_time'=>['required','min:1']
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
