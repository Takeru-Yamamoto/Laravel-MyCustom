@if ($isViewFooter())
    <footer class="main-footer">
        @if ($hasFooterSection())
            {{ $footer }}
        @else
            <p class="m-0 text-right">
                {{ $footerText() }}
            </p>
        @endif
    </footer>
@endif
