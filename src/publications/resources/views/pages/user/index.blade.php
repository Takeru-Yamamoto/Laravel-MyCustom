@extends('mycustom::page.card-noFooter')

@section('card-header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{ ___('user.title') }}
        <a class="float-right btn btn-primary"
            href="{{ route('user.createForm') }}">{{ ___('mycustom.word.create') }}</a>
    </div>
    <div class="card">
        <form method="get" action="{{ route('user.index') }}">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <p class="h5 m-0">{{ ___('user.word.search_user') }}</p>
                    <button
                        class="btn btn-info btn-sm">{{ ___('mycustom.word.search') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <label for="name">{{ ___('user.word.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $form->name }}">
                    </div>
                    <div class="col-4">
                        <label for="is_valid">{{ ___('mycustom.word.is_valid') }}</label>
                        <select class="form-control" name="is_valid" id="is_valid">
                            <option value="">{{ ___('mycustom.message.select_option') }}</option>
                            <option value="1" {{ isSelected(!is_null($form->isValid) && $form->isValid === 1) }}>
                                {{ ___('mycustom.word.valid') }}
                            </option>
                            <option value="0" {{ isSelected(!is_null($form->isValid) && $form->isValid === 0) }}>
                                {{ ___('mycustom.word.invalid') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('card-body')
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
                            @include('mycustom::components.btn.flg', [
                                'addClass' => config('mycustoms.btn.block'),
                                'flg' => $user->isValid,
                                'id' => $user->id,
                                'url' => route('user.changeIsValid'),
                            ])
                        </td>
                        <td>
                            <a class="btn btn-success btn-block"
                                href="{{ route('user.updateForm', ['id' => $user->id]) }}">{{ ___('mycustom.word.update') }}</a>
                        </td>
                        <td>
                            @include('mycustom::components.btn.delete', [
                                'addClass' => config('mycustoms.btn.block'),
                                'id' => $user->id,
                                'url' => route('user.delete'),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->appends(['name' => $form->name, 'is_valid' => $form->isValid])->links() }}
    @endif
@stop
