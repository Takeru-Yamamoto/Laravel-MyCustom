<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('user.create') }}
        </x-slot>

        <x-slot name="cardBody">
            <form method="post" action="{{ route('user.create') }}" id="{{ formId() }}">
                @csrf

                <x-mycustom::form.input name="name" type="text">
                    <x-slot name="title">
                        {{ ___('user.word.name') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="email" type="email">
                    <x-slot name="title">
                        {{ ___('user.word.email') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="password" type="password">
                    <x-slot name="title">
                        {{ ___('user.word.password') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="password_confirmation" type="password">
                    <x-slot name="title">
                        {{ ___('user.word.password_confirmation') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input-group name="role">
                    <x-slot name="title">
                        {{ ___('mycustom.word.role') }}
                    </x-slot>

                    @if (isSystem())
                        <x-mycustom::form.radio-button name="role" value="{{ UserRoleEnum::ADMIN->value }}"
                            isChecked="{{ intval(old('role')) === UserRoleEnum::ADMIN->value }}">
                            <x-slot name="title">
                                {{ ___('mycustom.word.admin') }}
                            </x-slot>
                        </x-mycustom::form.radio-button>
                    @endif

                    <x-mycustom::form.radio-button name="role" value="{{ UserRoleEnum::USER->value }}"
                        isChecked="{{ empty(old('role')) || intval(old('role')) === UserRoleEnum::USER->value }}">
                        <x-slot name="title">
                            {{ ___('mycustom.word.user') }}
                        </x-slot>
                    </x-mycustom::form.radio-button>
                </x-mycustom::form.input-group>
            </form>
        </x-slot>

        <x-slot name="cardFooter">
            <x-mycustom::button.submit-create formId="{{ formId() }}" addClass="btn-block" />
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
