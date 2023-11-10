<x-mycustom::form.input-group name="{{ $name }}">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="input-group">
        <div class="custom-file">
            @if ($isMultiple)
                <input type="file" class="custom-file-input" name="{{ $name }}[]"
                    id="input-file-{{ $type }}" multiple>
            @else
                <input type="file" class="custom-file-input" name="{{ $name }}"
                    id="input-file-{{ $type }}">
            @endif
            <label class="custom-file-label" data-browse="参照"
                for="input-file-{{ $type }}">{{ ___('mycustom.message.input_file') }}</label>
        </div>
        <div class="input-group-append">
            <button type="button" id="input-file-destroy-{{ $type }}"
                class="btn btn-outline-secondary input-group-text">{{ ___('mycustom.word.cancel') }}</button>
        </div>
    </div>
</x-mycustom::form.input-group>


<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init("input#input-file-{{ $type }}");
    document.getElementById('input-file-destroy-{{ $type }}').addEventListener('click', function() {
        var elem = document.getElementById('input-file-{{ $type }}');
        elem.value = '';
        elem.dispatchEvent(new Event('change'));
    });
</script>
