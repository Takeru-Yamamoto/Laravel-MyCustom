@extends('emails.template')

@section('text')
    <p>{{ ___('email.this_is_email_reset') }}</p>
    <p>{{ ___('email.complete_authentication_with_code') }}</p>
    <p>{{ ___('email.expiration_is', ['expiration_minute' => $expirationMinute]) }}</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>

    <p>{{ ___('email.authentication_code') }}: {{ $authenticationCode }}</p>

    <p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
@stop
