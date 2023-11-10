<x-mycustom::form.input-group name="{{ $name }}">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <select class="form-control {{ $addClass }}" name="{{ $name }}">
        {{ $slot }}
    </select>
</x-mycustom::form.input-group>
