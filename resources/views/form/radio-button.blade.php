<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}"
        id="{{ $name . '-' . $value }}" @checked($isChecked)>
    <label class="form-check-label" for="{{ $name . '-' . $value }}">
        {{ $title }}
    </label>
</div>
