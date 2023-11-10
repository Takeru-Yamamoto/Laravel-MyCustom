<x-mycustom::auth>
    <div class="card-header">
        <h3 class="card-title float-none text-center">
            {{ ___('auth.login_form') }}
        </h3>
    </div>

    <div class="card-body login-card-body">
        <form method="post" action="{{ route('login') }}" id="{{ formId() }}">
            @csrf
            <x-mycustom::form.input name="email" type="email">
                <x-slot name="title">
                    {{ ___('auth.email') }}
                </x-slot>
            </x-mycustom::form.input>

            <x-mycustom::form.input name="password" type="password">
                <x-slot name="title">
                    {{ ___('auth.password') }}
                </x-slot>
            </x-mycustom::form.input>

            <div class="d-flex justify-content-between align-items-center">
                <x-mycustom::form.check-box name="remember">
                    <x-slot name="title">
                        {{ ___('auth.remember_me') }}
                    </x-slot>
                </x-mycustom::form.check-box>
                <x-mycustom::button.submit-create formId="{{ formId() }}"
                    buttonText="{{ ___('auth.login') }}" buttonIcon="fa-solid fa-right-to-bracket" />
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
</x-mycustom::auth>
