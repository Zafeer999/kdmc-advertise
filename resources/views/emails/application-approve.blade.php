<x-mail::message>
# Application Approved successfully!

Your application {{$data->application_no}} for temporary advertise permission dated from ({{ $data->from_date }} to {{ $data->to_date }}) is approved successfully. Login to your portal and make payment to obtain certificate and QR code - KDMC.

Click on below link to proceed for payment.

<x-mail::button :url="route('initiate-payment')">
Pay Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
