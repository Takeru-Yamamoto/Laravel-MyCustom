<x-mycustom::auth>
    <div class="card-body login-card-body">
        <form method="post" action="{{ route('passwordReset') }}" id="{{ formId() }}">
            @csrf

            <x-mycustom::form.input-hidden name="email" type="email" value="{{ $email }}" />

            <x-mycustom::form.input-hidden name="token" type="text" value="{{ $token }}" />

            <x-mycustom::form.input name="password" type="password" isAutoFocus="true">
                <x-slot name="title">
                    {{ ___('auth.password') }}
                </x-slot>
            </x-mycustom::form.input>

            <x-mycustom::form.input name="password_confirmation" type="password">
                <x-slot name="title">
                    {{ ___('auth.password_confirmation') }}
                </x-slot>
            </x-mycustom::form.input>
        </form>
    </div>

    <div class="card-footer">
        <x-mycustom::button.submit-create formId="{{ formId() }}" addClass="btn-block"
            buttonText="{{ ___('auth.reset_password') }}" />
    </div>
</x-mycustom::auth>
