<a class="btn btn-success {{ $addClass }}" href="{{ $url }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
