<x-mycustom::page>

    <x-mycustom::card.card>
        <x-slot name="cardHeader">
            {{ ___('dashboard.title') }}
        </x-slot>

        <x-slot name="cardBody">
            <p class="m-0">Hello System!</p>
        </x-slot>

    </x-mycustom::card.card>

</x-mycustom::page>
