<x-mail::message>
# Application Rejected!

Your application {{$data->application_no}} for temporary advertise permission dated from ({{ $data->from_date }} to {{ $data->to_date }}) is rejected. Login to the portal for more info. - KDMC

Click on below link for login to your account.

<x-mail::button :url="url('/')">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
