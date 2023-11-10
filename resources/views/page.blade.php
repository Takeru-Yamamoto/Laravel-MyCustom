<x-mycustom::template>
    <x-slot name="bodyClass">
        {{ $bodyClass }}
    </x-slot>

    <x-slot name="body">
        <div class="wrapper">
            <x-mycustom::part.navbar />

            <x-mycustom::part.sidebar />

            <div class="content-wrapper">
                @isset($pageHeader)
                    <div class="content-header">
                        <div class="container-fluid">
                            <h1>{{ $pageHeader }}</h1>
                        </div>
                    </div>
                @endisset

                <div class="content {{ isset($pageHeader) ? '' : 'pt-3' }}">
                    <div class="container-fluid">

                        <x-mycustom::part.alert />

                        {{ isset($modal) ? $modal : '' }}

                        {{ $slot }}
                    </div>
                </div>
            </div>

            <x-mycustom::part.footer />
        </div>
    </x-slot>

</x-mycustom::template>
