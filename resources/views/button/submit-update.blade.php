<a class="btn btn-success form-submit-btn {{ $addClass }}" data-form="{{ $formId }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
