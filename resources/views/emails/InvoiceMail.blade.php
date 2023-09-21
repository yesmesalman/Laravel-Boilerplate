@component('mail::message')

Thank you for your inquiry. We have created an invoice for you with the following details:

Amount: ${{ $body['amount'] }}<br>Description: {{ $body['description'] }}

Please click the button below to view and pay the invoice:

@component('mail::button', ['url' => $body['invoiceLink']])
Pay Invoice
@endcomponent



If you have any questions or need further assistance, feel free to contact us.

Thank you!

Best regards,
{{ config('app.name') }}
@endcomponent
