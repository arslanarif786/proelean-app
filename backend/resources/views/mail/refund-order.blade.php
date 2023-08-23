@component('mail::message')
# Hi {{$name}}!

Your Refund Application has been recieved against this #{{$order_no}} order

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
