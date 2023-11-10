<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link border-bottom border-gray">
        @if (!empty($myCustomIconPath()))
            <img src="{{ $myCustomIconPath() }}" alt="{{ $myCustomSiteName() }}" class="brand-image img-circle elevation-3">
        @endif

        <span class="brand-text font-weight-light">{{ $myCustomSiteName() }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @foreach ($myCustomPages() as $page)
                    <x-mycustom::part.sidebar.item :page="$page" />
                @endforeach

            </ul>
        </nav>
    </div>
</aside>
