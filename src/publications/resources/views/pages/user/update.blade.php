@extends('mycustom::page.card')

@section('card-header')
    {{ ___('user.update') }}
@stop

@section('card-body')
    <form method="post" action="{{ route('user.update') }}" id="{{ formId() }}">
        @csrf
        <input type="number" name="id" value="{{ $user->id }}" hidden />
        <div class="form-group">
            <label for="name">{{ ___('user.word.name') }}</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
            <label for="email">{{ ___('user.word.email') }}</label>
            <input type="email" name="email" class="form-control" id="email"
                value="{{ old('email', $user->email) }}">
        </div>
        <div class="form-group">
            <label for="password">{{ ___('user.word.password') }} <span
                    class='text-sm text-danger'>{{ ___('user.message.input_only_update') }}</span></label>
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
                        {{ isChecked(old('role', $user->role) == 5) }}>
                    <label class="custom-control-label" for="role-5">
                        Admin
                    </label>
                </div>
            @endif
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="role" value="10" id="role-10"
                    {{ isChecked(old('role', $user->role) == 10) }}>
                <label class="custom-control-label" for="role-10">
                    User
                </label>
            </div>
        </div>
    </form>
@stop

@section('card-footer')
    <a class="btn btn-success btn-block form-submit-btn"
        data-form="{{ formId() }}">{{ ___('mycustom.word.update') }}</a>
@stop
