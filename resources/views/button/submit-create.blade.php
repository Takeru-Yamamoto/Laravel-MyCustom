<a class="btn btn-primary form-submit-btn {{ $addClass }}" data-form="{{ $formId }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
