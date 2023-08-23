@component('mail::message')
# Hi {{$buyer_name}}!

The body of your message.

@component('mail::button', ['url' => $url])
View Job
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
