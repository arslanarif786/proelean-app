<?php

namespace App\Http\Requests\Seller;

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
        return Order::where("seller_id", auth()->id())
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
            'type'=>['required','in:5,2,6,8,9'],
            'delivery_note'=>['required_if:type,2','min:10'],
            'delivered_file'=>['required_if:type,2','mimes:png,jpg,zip,pdf,mp4,docs', 'max:1024'],
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
