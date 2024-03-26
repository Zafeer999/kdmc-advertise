<x-mail::message>
# Application submitted successfully!

You have successfully submitted your temporary hoarding permission application dated from {{ $application->from_date }} To {{ $application->to_date }},
application is currently under review, you will get further updates on it shortly.

Click on below link to proceed for payment.

<x-mail::button :url="route('initiate-payment',$application->id)">
Pay Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
