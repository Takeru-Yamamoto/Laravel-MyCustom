<a class="btn btn-primary {{ $addClass }}" href="{{ $url }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
