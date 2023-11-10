<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            <div class="d-flex justify-content-between align-items-center mb-3">
                {{ ___('user.title') }}
                <x-mycustom::button.create url="{{ route('user.createForm') }}" addClass="float-right" />
            </div>
            <div class="card">
                <form method="get" action="{{ route('user.index') }}" id="{{ formId() }}">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <p class="h5 m-0">{{ ___('user.word.search_user') }}</p>
                            <x-mycustom::button.submit-search formId="{{ formId() }}" addClass="btn-sm" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <x-mycustom::form.input name="name" type="text" value="{{ $form->name }}">
                                    <x-slot name="title">
                                        {{ ___('user.word.name') }}
                                    </x-slot>
                                </x-mycustom::form.input>
                            </div>
                            <div class="col-4">
                                <x-mycustom::form.select name="is_valid">
                                    <x-slot name="title">
                                        {{ ___('mycustom.word.is_valid') }}
                                    </x-slot>

                                    <x-mycustom::form.select-option>
                                        <x-slot name="title">
                                            {{ ___('mycustom.message.select_option') }}
                                        </x-slot>
                                    </x-mycustom::form.select-option>

                                    <x-mycustom::form.select-option value="1"
                                        isSelected="{{ !is_null($form->isValid) && $form->isValid === 1 }}">
                                        <x-slot name="title">
                                            {{ ___('mycustom.word.valid') }}
                                        </x-slot>
                                    </x-mycustom::form.select-option>

                                    <x-mycustom::form.select-option value="1"
                                        isSelected="{{ !is_null($form->isValid) && $form->isValid === 0 }}">
                                        <x-slot name="title">
                                            {{ ___('mycustom.word.invalid') }}
                                        </x-slot>
                                    </x-mycustom::form.select-option>
                                </x-mycustom::form.select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </x-slot>

        <x-slot name="cardBody">
            @if (is_null($users))
                <p class="m-0">{{ ___('user.message.user_not_found') }}</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <th width="55%">{{ ___('user.word.name') }}</th>
                        <th width="15%"></th>
                        <th width="15%"></th>
                        <th width="15%"></th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    <x-mycustom::button.flag id="{{ $user->id }}"
                                        url="{{ route('user.changeIsValid') }}" isValid="{{ $user->isValid }}"
                                        addClass="btn-block" />
                                </td>
                                <td>
                                    <x-mycustom::button.update
                                        url="{{ route('user.updateForm', ['id' => $user->id]) }}"
                                        addClass="btn-block" />
                                </td>
                                <td>
                                    <x-mycustom::button.delete id="{{ $user->id }}"
                                        url="{{ route('user.delete') }}" addClass="btn-block" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->appends(['name' => $form->name, 'is_valid' => $form->isValid])->links() }}
            @endif
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
