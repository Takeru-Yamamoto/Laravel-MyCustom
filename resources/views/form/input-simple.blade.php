<input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $addClass }}"
    value="{{ empty($value) ? old($name) : old($name, $value) }}" @if ($isReadonly) readonly @endif
    @if ($isDisabled) disabled @endif @if ($isAutoFocus) autofocus @endif>
