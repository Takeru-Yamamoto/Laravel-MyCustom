<li class="nav-item pointer">
    <a class="nav-link {{ $navLinkClass }}" href="{{ $navLinkHref }}">

        @if (!empty($navLinkIcon))
            <i class="nav-icon {{ $navLinkIcon }} {{ $navLinkIconClass }}"></i>
        @endif

        <p class="{{ $navLinkTitleClass }}">
            {{ $navLinkTitle }}
        </p>
    </a>
</li>
