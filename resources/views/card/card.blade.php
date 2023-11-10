<div class="row justify-content-center">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">{{ $cardHeader }}</h4>
            </div>

            <div class="card-body">
                {{ $cardBody }}
            </div>

            @if (isset($cardFooter))
                <div class="card-footer">
                    {{ $cardFooter }}
                </div>
            @endif
        </div>
    </div>
</div>
