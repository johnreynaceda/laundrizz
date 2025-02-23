<div class="mt-1">
    @if ($getRecord()->is_active == 0)
        <x-badge label="Active" icon="sparkles" positive class="font-normal" />
    @else
        <x-badge negative icon="exclamation-triangle" class="font-normal" label="Inactive" />
    @endif

</div>
