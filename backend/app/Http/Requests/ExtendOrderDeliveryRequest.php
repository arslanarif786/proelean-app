<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class ExtendOrderDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Order::where('id', customDecrypt(request()->order_id))->where('seller_id', auth()->id())->firstOrFail()
        ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => ['required'],
            'extended_delivery_days' => ['string','min:4'],
            'description' => ['required', 'string', 'min:3']
        ];
    }

    public function withValidator($validator)
    {
        abortIfValidationFails($validator);
    }
}
