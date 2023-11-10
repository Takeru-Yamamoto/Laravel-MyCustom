<a data-url="{{ $url }}" data-id="{{ $id }}" class="btn btn-danger delete-btn {{ $addClass }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
