@component('mail::message')
# Introduction

Welcome to Grocers

You have selected and maden an admin 

your username: {{ $data['email'] }}
password: {{ $data['password'] }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
