@component('mail::message')
# ORDER LATE

Your order #{{$order_no}} over due time.

@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
