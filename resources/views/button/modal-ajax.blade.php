<a data-url="{{ $url }}" data-id="{{ $id }}" data-type="{{ $type }}"
    data-modal-id="{{ $modalId }}" class="btn btn-info ajax-modal-btn {{ $addClass }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
