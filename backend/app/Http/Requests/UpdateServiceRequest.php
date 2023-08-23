<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user &&  $user->isFreelancer == 1 ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required|min:1|sometimes',
            'sub_category_id'=>'required|min:1|sometimes',
            's_description'=>'required|min:6|sometimes',
            'description'=>'required|min:15|sometimes',
            'price'=>'required|min:1|sometimes',
            'delivery_time'=>'required|sometimes',
            'additional_info'=>'min:4|sometimes',
            'revision'=>'min:0',
            'banner'=>'required|sometimes',
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
