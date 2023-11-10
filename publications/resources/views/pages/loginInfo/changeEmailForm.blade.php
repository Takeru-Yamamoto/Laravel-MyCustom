<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('login_info.change_email_form') }}
        </x-slot>

        <x-slot name="cardBody">
            <form method="post" action="{{ route('login_info.createAuthenticationCode') }}" id="{{ formId() }}">
                @csrf
                <x-mycustom::form.input-hidden name="user_id" type="number" value="{{ $user->id }}" />

                <x-mycustom::form.input name="email" type="email">
                    <x-slot name="title">
                        {{ ___('login_info.word.updated_email') }}
                    </x-slot>
                </x-mycustom::form.input>
            </form>
        </x-slot>

        <x-slot name="cardFooter">
            <x-mycustom::button.submit-create formId="{{ formId() }}"
                buttonText="{{ ___('login_info.message.create_authentication_code') }}" addClass="btn-block" />
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
