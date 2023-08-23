@component('mail::message')
<img src="{{asset('assets/images/video.png')}}" style="width:100%;height:200px">
# Welcome to Fiverr!

With one click, you’ve opened the door to the world’s most talented freelancer marketplace.

Finally, there’s a lifetime of opportunities in one place. All those projects you have planned or on hold? Just one click away. No need to prioritize, postpone, or procrastinate – thousands of skilled professionals are ready to take on your next project, from content and design to business and development. It’s time to start seeing those “to-do” tasks “done”.
Welcome to the future of work.

@component('mail::button', ['url' => ''])
Start Exploring
@endcomponent

Explore top services<br>

{{ config('app.name') }}
@endcomponent
