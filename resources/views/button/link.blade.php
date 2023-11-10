<a class="btn btn-info {{ $addClass }}" href="{{ $url }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
