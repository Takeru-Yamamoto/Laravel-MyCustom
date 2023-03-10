@extends('mycustom::page.card')

@section('card-header')
    {{ ___('user.create') }}
@stop

@section('card-body')
    <form method="post" action="{{ route('user.create') }}" id="{{ formId() }}">
        @csrf
        <div class="form-group">
            <label for="name">{{ ___('user.word.name') }}</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">{{ ___('user.word.email') }}</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">{{ ___('user.word.password') }}</label>
            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ ___('user.word.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                value="{{ old('password_confirmation') }}">
        </div>
        <label for="role">{{ ___('user.word.role') }}</label>
        <div class="form-group" id="role">
            @if (isSystem())
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="role" value="5" id="role-5"
                        {{ isChecked(old('role') == '5') }}>
                    <label class="custom-control-label" for="role-5">
                        Admin
                    </label>
                </div>
            @endif
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="role" value="10" id="role-10"
                    {{ isChecked(empty(old('role')) || old('role') == '10') }}>
                <label class="custom-control-label" for="role-10">
                    User
                </label>
            </div>
        </div>
    </form>
@stop

@section('card-footer')
    <a class="btn btn-primary btn-block form-submit-btn"
        data-form="{{ formId() }}">{{ ___('mycustom.word.create') }}</a>
@stop
