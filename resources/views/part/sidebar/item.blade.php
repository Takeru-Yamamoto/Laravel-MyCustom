@if ($isUserCan())
    @if ($hasChildren())
        <x-mycustom::part.sidebar.tree :page="$page" />
    @else
        <x-mycustom::part.sidebar.link :page="$page" />
    @endif
@endif
