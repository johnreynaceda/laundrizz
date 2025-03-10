<div class="mt-1">
    @if ($getRecord()->is_active == false)
        <x-badge negative icon="exclamation-triangle" class="font-normal" label="Inactive" />
    @else

        <x-badge label="Active" icon="sparkles" positive class="font-normal" />
    @endif

</div>