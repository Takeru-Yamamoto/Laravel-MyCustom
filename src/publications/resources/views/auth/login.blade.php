@extends('mycustom::auth')

@section('auth-card')
    <div class="card-header">
        <h3 class="card-title float-none text-center">
            {{ ___('auth.login_form') }}
        </h3>
    </div>

    <div class="card-body login-card-body">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="{{ ___('auth.email') }}" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa-solid fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="{{ ___('auth.password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa-solid fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">{{ ___('auth.remember_me') }}</label>
                    </div>
                </div>
                <div class="col-5">
                    <button type=submit class="btn btn-block btn-flat btn-primary">
                        <span class="fa-solid fa-right-to-bracket"></span>
                        {{ ___('auth.login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer">
        <p class="my-0">
            <a href="{{ route('showEmailInputForm') }}">
                {{ ___('auth.forgot_password') }}
            </a>
        </p>
    </div>
@stop
