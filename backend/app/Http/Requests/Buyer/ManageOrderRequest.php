<?php

namespace App\Http\Requests\Buyer;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class ManageOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Order::where("user_id", auth()->id())
            ->where('id', customDecrypt(request()->order_no))
            ->orWhere('orderNo', request()->order_no)
            ->firstOrFail() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_no'=>['required'],
            'type'=>['required','in:5,3,4,8,9,10'],
            'revision_description'=>['required_if:type,3','min:8'],
            'description'=>['required_if:type,10','min:8'],
            'rating'=>['required_if:type,10','min:1'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
