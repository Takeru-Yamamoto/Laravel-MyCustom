<li class="nav-item pointer has-treeview">
    <a class="nav-link {{ $navLinkClass }}">

        @if (!empty($navLinkIcon))
            <i class="nav-icon {{ $navLinkIcon }} {{ $navLinkIconClass }}"></i>
        @endif

        <p class="{{ $navLinkTitleClass }}">
            {{ $navLinkTitle }}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        @foreach ($children as $child)
            <x-mycustom::part.sidebar.item :page="$child" />
        @endforeach
    </ul>
</li>
