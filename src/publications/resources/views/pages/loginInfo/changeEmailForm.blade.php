@extends('mycustom::page.card')

@section('card-header')
    {{ ___('login_info.change_email_form') }}
@stop

@section('card-body')
    <form method="get" action="{{ route('login_info.authenticationCodeForm') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="user_id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label>{{ ___('login_info.word.updated_email') }}</label>
            <input type="email" name="email" class="form-control">
        </div>
    </form>
@stop

@section('card-footer')
    <a class="btn btn-primary btn-block form-submit-btn"
        data-form="{{ formId() }}">{{ ___('login_info.message.authentication_code_form') }}</a>
@stop
