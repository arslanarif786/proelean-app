<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $user = auth()->user();
        // return $user &&  $user->isFreelancer == 1 ? true : false;
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
            'category_id'=>'required|min:1',
            'sub_category_id'=>'required|min:1',
            's_description'=>'required|min:5',
            'description'=>'required|min:20',
            'price'=>'required|min:1|max:9999',
            'delivery_time'=>'required',
            'additional_info'=>'',
            'revision'=>'numeric|min:0',
            'banner'=>'required|array',
            'banner.*'=>'image|mimes:jpg,jpeg,png,webp|max:2048',
            'lat'=>'',
            'lng'=>''
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
