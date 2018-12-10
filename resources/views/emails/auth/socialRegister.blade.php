@component('mail::message')
# Hi, {{ $user->name }}

Thanks for registeration.

Your New Password is : {{ $newPassword }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
