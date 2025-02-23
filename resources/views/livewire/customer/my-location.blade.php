<div x-data="{
    slideOverOpen: @entangle('add_modal')
}">
    <div class="border-y flex justify-between text-gray-600 py-2">
        <div class="flex space-x-3  items-center" wire:click="addLocation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <span>Add Location</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </div>
    </div>
    <div class="mt-5">
        <ul>
            @forelse ($locations as $item)
                <li class="py-2 border-b">
                    <div class="flex justify-between items-center">
                        <h1 class="font-semibold">{{ auth()->user()->name }}</h1>
                        <button wire:click="editLocation({{ $item->id }})" class="text-red-500">
                            Edit
                        </button>
                    </div>
                    <h1 class="text-gray-600 text-sm">{{ $item->contact }}</h1>
                    <p class="text-gray-600 text-sm">{{ $item->address }}</p>
                    @if ($item->is_default)
                        <x-badge label="Default" squared flat gray class="font-normal" />
                    @endif
                </li>
            @empty
            @endforelse
        </ul>
    </div>
    <template x-teleport="body">
        <div x-show="slideOverOpen" @keydown.window.escape="slideOverOpen=false" class="relative z-[99]">
            <div x-show="slideOverOpen" x-transition.opacity.duration.600ms
                class="fixed inset-0 bg-black bg-opacity-10"></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div x-show="slideOverOpen"
                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                            class="w-screen max-w-md">
                            <div
                                class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
                                <div class="px-4 sm:px-5">
                                    <div class="flex items-start justify-between pb-1">
                                        <h2 class="text-base font-semibold leading-6 text-gray-900"
                                            id="slide-over-title">
                                            {{ $is_edit ? 'Update Location' : 'Add Location' }}
                                        </h2>
                                        <div class="flex items-center h-auto ml-3">
                                            <button @click="slideOverOpen=false"
                                                class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span>Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                    <div class="absolute inset-0 px-4 sm:px-5">
                                        <div class="relative rounded-md border-neutral-300">
                                            <div>
                                                {{ $this->form }}
                                            </div>
                                            <div class="mt-5 space-y-2">
                                                <x-button label="SAVE" sm squared right-icon="arrow-right"
                                                    wire:click="save" spinner="save" class="font-medium w-full"
                                                    emerald />
                                                @if ($is_edit)
                                                    <x-button label="DELETE" sm squared right-icon="trash"
                                                        wire:click="delete" spinner="delete" class="font-medium w-full"
                                                        negative />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
