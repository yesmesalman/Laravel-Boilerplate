@component('mail::message')

Hello, {{ $body['name'] }}!

You otp code is {{$body['otp']}}!

Welcome to our platform!

We are excited to have you on board. Please use the following credentials to log in to our platform:


We recommend that you change your password after logging in for the first time.


If you have any questions or concerns, please do not hesitate to contact us.

Thanks,
{{ config('app.name') }}
@endcomponent