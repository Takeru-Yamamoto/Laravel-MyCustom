@extends('mycustom::page.card')

@section('card-header')
    {{ ___('login_info.update') }}
@stop

@section('card-body')
    <form method="post" action="{{ route('login_info.update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label for="name">{{ ___('login_info.word.name') }}</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
            @if (isAdminHigher())
                <label for="email">{{ ___('login_info.word.email') }}</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @else
                <label class="d-flex align-items-center">
                    {{ ___('login_info.word.email') }}
                    <a class="btn btn-link"
                        href="{{ route('login_info.changeEmailForm') }}">{{ ___('login_info.message.change_email_form') }}</a>
                </label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                    readonly>
            @endif
        </div>
        <div class="form-group">
            <label for="password">{{ ___('login_info.word.password') }}</label>
            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ ___('login_info.word.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                value="{{ old('password_confirmation') }}">
        </div>
    </form>
@stop

@section('card-footer')
    <a class="btn btn-success btn-block form-submit-btn"
        data-form="{{ formId() }}">{{ ___('mycustom.word.update') }}</a>
@stop
