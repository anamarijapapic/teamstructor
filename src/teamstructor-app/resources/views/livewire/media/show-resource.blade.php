<div>
    <div class="flex flex-col items-center pt-4 bg-white border-gray-200 rounded-md shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
            class="w-20 h-20 stroke-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
            </path>
        </svg>

        <h3 class="font-bold my-3">{{ $resource->file_name }}</h3>

        <div class="flex flex-col items-center mt-3">
            <x-button class="mb-3" wire:click="download" wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3">
                    </path>
                </svg>
                {{ __('Download') }}
            </x-button>

            <x-secondary-button class="mb-3" data-popover-target="popover-hover-{{ $resource->id }}"
                data-popover-placement="bottom" data-popover-trigger="hover" wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ __('Details') }}
            </x-secondary-button>
        </div>
    </div>

    <div data-popover id="popover-hover-{{ $resource->id }}" role="tooltip"
        class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $resource->file_name }}</h3>
        </div>

        <div class="px-3 py-2">
            @if ($resource->type == 'image')
                <div class="flex justify-center p-2">
                    {{ $resource }}
                </div>
            @endif
            <p>{{ __('Uploaded:') }} {{ $resource->created_at->diffForHumans() }}</p>
            <p>{{ __('Author:') }} {{ $author->name }}</p>
            <p>{{ __('Type:') }} {{ $resource->type }}</p>
            <p>{{ __('Size:') }} {{ $resource->humanReadableSize }}</p>
        </div>
        <div data-popper-arrow></div>
    </div>
</div>
