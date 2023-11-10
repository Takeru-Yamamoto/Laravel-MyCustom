<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('user.update') }}
        </x-slot>

        <x-slot name="cardBody">
            <form method="post" action="{{ route('user.update') }}" id="{{ formId() }}">
                @csrf

                <x-mycustom::form.input-hidden name="id" type="number" value="{{ $user->id }}" />

                <x-mycustom::form.input name="name" type="text" value="{{ $user->name }}">
                    <x-slot name="title">
                        {{ ___('user.word.name') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="email" type="email" value="{{ $user->email }}">
                    <x-slot name="title">
                        {{ ___('user.word.email') }}
                    </x-slot>
                </x-mycustom::form.input>

                <x-mycustom::form.input name="password" type="password">
                    <x-slot name="title">
                        {{ ___('user.word.password') }}
                        <span class='text-sm text-danger'>{{ ___('user.message.input_only_update') }}</span>
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
                            isChecked="{{ intval(old('role', $user->role->value)) === UserRoleEnum::ADMIN->value }}">
                            <x-slot name="title">
                                {{ ___('mycustom.word.admin') }}
                            </x-slot>
                        </x-mycustom::form.radio-button>
                    @endif

                    <x-mycustom::form.radio-button name="role" value="{{ UserRoleEnum::USER->value }}"
                        isChecked="{{ intval(old('role', $user->role->value)) === UserRoleEnum::USER->value }}">
                        <x-slot name="title">
                            {{ ___('mycustom.word.user') }}
                        </x-slot>
                    </x-mycustom::form.radio-button>
                </x-mycustom::form.input-group>
            </form>
        </x-slot>

        <x-slot name="cardFooter">
            <x-mycustom::button.submit-update formId="{{ formId() }}" addClass="btn-block" />
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
