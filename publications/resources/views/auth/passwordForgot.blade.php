<x-mycustom::auth>
    <div class="card-header">
        <h3 class="card-title float-none text-center">
            {{ ___('auth.reset_password') }}
        </h3>
    </div>

    <div class="card-body login-card-body">
        <form method="post" action="{{ route('receiveEmailAddress') }}" id="{{ formId() }}">
            @csrf

            <x-mycustom::form.input name="email" type="email" isAutoFocus="true">
                <x-slot name="title">
                    {{ ___('auth.email') }}
                </x-slot>
            </x-mycustom::form.input>
        </form>
    </div>

    <div class="card-footer">
        <x-mycustom::button.submit-create formId="{{ formId() }}" addClass="btn-block"
            buttonText="{{ ___('auth.send_reset_link') }}" buttonIcon="fa-solid fa-share-from-square" />
    </div>
</x-mycustom::auth>
