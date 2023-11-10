<x-mycustom::template>
    <x-slot name="bodyClass">
        {{ $bodyClass }}
    </x-slot>

    <x-slot name="body">
        <div class="login-box">
            <div class="login-logo d-flex justify-content-center align-items-center">
                @if (!empty($myCustomIconPath()))
                    <img src="{{ $myCustomIconPath() }}" alt="{{ $myCustomSiteName() }}" height="50">
                @endif

                <span>{{ $myCustomSiteName() }}</span>
            </div>

            <x-mycustom::part.alert />

            <div class="card card-outline card-primary">
                {{ $slot }}
            </div>
        </div>
    </x-slot>
</x-mycustom::template>
