@component('mail::message')
# Hi {{$seller_name}}!

Your Service Created Successfully..


<!-- @component('mail::button', ['url' => ''])
View Service
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
