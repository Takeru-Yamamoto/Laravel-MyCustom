<a data-modal-id="{{ $modalId }}" class="btn btn-info modal-btn {{ $addClass }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
