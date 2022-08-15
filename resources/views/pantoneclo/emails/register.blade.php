@component('mail::message')
Dear $user['name'],

Welcome to Pantoneclo

You have created an account and credentials are given below:

your username: {{ $user['email'] }}
password: {{ $user['password'] }}

@component('mail::button', ['url' => route('login')])
Click to Login
@endcomponent

Thanks,<br>
Pantoneclo
@endcomponent
