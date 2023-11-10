<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $modalTitle }}
                </h5>
                <button type="button" class="close" id="{{ $modalId }}-dismiss-button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $modalBody }}
            </div>
            <div class="modal-footer">
                {{ $modalFooter }}
            </div>
        </div>
    </div>
</div>

@if (!empty($data))
    <script>
        let modal = document.getElementById("{{ $modalId }}");

        @foreach ($data as $key => $value)
            modal.dataset.{{ $key }} = {{ $value }};
        @endforeach
    </script>
@endif

@if ($isStatic)
    <script>
        let modal = document.getElementById("{{ $modalId }}");

        modal.dataset.bsBackdrop = "static";

        let dismissButton = document.getElementById("{{ $modalId }}-dismiss-button");

        dismissButton.style.display = "none";
    </script>
@endif
