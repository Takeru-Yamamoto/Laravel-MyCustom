<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('login_info.authentication_code_form') }}
        </x-slot>

        <x-slot name="cardBody">
            <p>{{ ___('login_info.message.sent_email_to_entered_address') }}</p>
            <p>{{ ___('login_info.message.enter_authentication_code_in_email') }}</p>
            <p>{{ ___('login_info.message.entry_within_expiration_minute') }}
            </p>

            <form method="post" action="{{ route('login_info.changeEmail') }}" id="{{ formId() }}">
                @csrf
                <x-mycustom::form.input-hidden name="user_id" type="number" value="{{ $user->id }}" />

                <x-mycustom::form.input name="authentication_code" type="text">
                    <x-slot name="title">
                        {{ ___('login_info.word.authentication_code') }}
                    </x-slot>
                </x-mycustom::form.input>
            </form>
        </x-slot>

        <x-slot name="cardFooter">
            <x-mycustom::button.submit-create formId="{{ formId() }}" buttonText="{{ ___('mycustom.word.send') }}"
                addClass="btn-block" />
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
