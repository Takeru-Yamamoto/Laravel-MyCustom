<a data-url="{{ $url }}" data-id="{{ $id }}" data-flg="{{ intval(!$isValid) }}"
    class="btn flg-change-btn {{ $buttonColor }} {{ $addClass }}">
    @if (!empty($buttonIcon))
        <i class="{{ $buttonIcon }}"></i>
    @endif

    {{ $buttonText }}
</a>
