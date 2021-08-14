@component('mail::message')
# We have received your feedback

Hi {{$feed->first_name}} {{$feed->last_name}},

We have received your feedback with subject <strong>{{$feed->subject}}</strong>
<br>
We will reply to you within 3 working days.<br>

Thank you,<br>
{{ config('app.name') }}
@endcomponent
