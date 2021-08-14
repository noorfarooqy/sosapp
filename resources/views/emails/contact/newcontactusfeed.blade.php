@component('mail::message')
# New feedback from {{$feed->first_name}} {{$feed->last_name}}

We have recieved new feedback with the following details:-
<br>
<strong>From:</strong> {{$feed->first_name}} {{$feed->last_name}} - {{$feed->email}}
<br>
<strong>Subject:</strong> {{$feed->subject}} <br>
<strong>Message:</strong> <br>
{{$feed->message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
