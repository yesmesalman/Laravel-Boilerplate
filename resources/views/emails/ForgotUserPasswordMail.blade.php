@component('mail::message')

# Hello, {{ $body['name'] }}!

## Forgot Your Password?
<br />

That's okay, it happens! Enter this OTP in your mobile application to update password.
<br />

# {{ $body['otp'] }}
<br />

Click on the button below to reset your password:

@component('mail::button', ['url' => $body['url']])
Reset Your Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
