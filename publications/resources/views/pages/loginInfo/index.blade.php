<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('login_info.update') }}
        </x-slot>

        <x-slot name="cardBody">
            <form method="post" action="{{ route('login_info.update') }}" id="{{ formId() }}">
                @csrf
                <x-mycustom::form.input-hidden name="id" type="number" value="{{ $user->id }}" />

                <x-mycustom::form.input name="name" type="text" value="{{ $user->name }}">
                    <x-slot name="title">
                        {{ ___('login_info.word.name') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="email" type="email" value="{{ $user->email }}"
                    isReaonly="{{ !isAdminHigher() }}">
                    <x-slot name="title">
                        {{ ___('login_info.word.email') }}

                        @if (!isAdminHigher())
                            <a class="btn btn-link" href="{{ route('login_info.changeEmailForm') }}">
                                {{ ___('login_info.message.change_email_form') }}
                            </a>
                        @endif
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="password" type="password">
                    <x-slot name="title">
                        {{ ___('login_info.word.password') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="password_confirmation" type="password">
                    <x-slot name="title">
                        {{ ___('login_info.word.password_confirmation') }}
                    </x-slot>
                </x-mycustom::form.input>
            </form>
        </x-slot>

        <x-slot name="cardFooter">
            <x-mycustom::button.submit-update formId="{{ formId() }}" addClass="btn-block" />
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
