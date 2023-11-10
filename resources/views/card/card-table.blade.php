<x-mycustom::card.card>
    <x-slot name="cardHeader">
        {{ $cardHeader }}
    </x-slot>

    <x-slot name="cardBody">
        <table class="table table-hover">
            @if (isset($tableHeader))
                <thead>
                    {{ $tableHeader }}
                </thead>
            @endif

            <tbody>
                {{ $tableBody }}
            </tbody>
        </table>
    </x-slot>
</x-mycustom::card.card>
