@extends('mycustom::page.card')

@section('card-header')
    {{ ___('login_info.authentication_code_form') }}
@stop

@section('card-body')
    <p>{{ ___('login_info.message.sent_email_to_entered_address') }}</p>
    <p>{{ ___('login_info.message.enter_authentication_code_in_email') }}</p>
    <p>{{ ___('login_info.message.expiration_is', ['expiration_minute' => config('mycustoms.presentation-domain.email_expiration_minute')]) }}
    </p>

    <form method="post" action="{{ route('login_info.changeEmail') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="user_id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <div class="d-flex">
                <label>{{ ___('login_info.word.authentication_code') }}</label>
            </div>
            <input type="text" name="authentication_code" class="form-control">
        </div>
    </form>
@stop

@section('card-footer')
    <a class="btn btn-primary btn-block form-submit-btn"
        data-form="{{ formId() }}">{{ ___('mycustom.word.send') }}</a>
@stop
