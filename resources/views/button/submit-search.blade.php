<a class="btn btn-info form-submit-btn {{ $addClass }}" data-form="{{ $formId }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
