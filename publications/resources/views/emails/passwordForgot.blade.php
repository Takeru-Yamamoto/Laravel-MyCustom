@extends('emails.template')

@section('text')
    <p>{{ ___('email.this_is_password_forgot') }}</p>
    <p>{{ ___('email.check_url_for_password_change') }}</p>
    <p>{{ ___('email.expiration_is', ['expiration_minute' => $expirationMinute]) }}</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p><a href="{{ route('passwordResetForm', ['crypted' => $crypted]) }}">{{ ___('email.change_password_url') }}</a></p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
