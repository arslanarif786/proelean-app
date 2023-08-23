@component('mail::message')
# Hi {{$seller_name}}!

<p> {{$buyer_name}} {{$state}}
is due <b> {{$end_date}} </b>.
</p>

@component('mail::button', ['url' => $url])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
