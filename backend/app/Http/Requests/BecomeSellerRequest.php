<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BecomeSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user=auth()->user();
        return $user->isFreelancer != 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'freelancer_title'=>['required','min:15'],
            'category_id'=>['required'],
            'country_id'=>['required'],
            'sub_category_id'=>['required'],
            'description'=>['required','min:20'],
            'cinic' => ['required','mimes:zip,jpg,png,jpeg,pdf,docs','max:1024'],
            'availability'=>['required'],
            'lang' => ['required','min:3'],
            'facebook'=>[''],
            'linked_in'=>[''],
            'portfolio'=>[''],
            'google_plus'=>[''],
            'twitter'=>[''],
            'instagram'=>[''],
        ];
    }
    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
