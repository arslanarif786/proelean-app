@component('mail::message')
# Hi {{$seller_name}}!

<p> You've just received an order from {{$buyer_name}}! Feels good, right?
Order #{{$order_no}} is due <b> {{$end_date}} </b>.
</p>

@component('mail::button', ['url' => $url])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
