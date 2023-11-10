@aware(['accordionId'])

<div class="accordion-item">
    <div class="accordion-header" id="accordion-header-{{ $accordionType }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-{{ $accordionType }}"
            aria-expanded="true" aria-controls="accordion-item-{{ $accordionType }}">
            {{ $accordionTitle }}
        </button>
    </div>
    <div id="accordion-item-{{ $accordionType }}" class="accordion-collapse collapse" aria-labelledby="accordion-header-{{ $accordionType }}"
        data-bs-parent="#accordion-{{ $accordionId }}">
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>
