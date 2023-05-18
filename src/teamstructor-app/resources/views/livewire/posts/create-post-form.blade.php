<div class="w-full">
    <form class="mb-6 w-full" wire:submit.prevent="store">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-lg">
                <h4 class="text-2xl font-bold mt-3 text-gray-900">{{ __('Start a discussion!') }}
                </h4>
                <div class="mt-4">
                    <x-input id="title" type="text" class="mt-1 block w-full" placeholder="{{ __('Title') }}"
                        wire:model.defer="title" />
                    <x-input-error for="title" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-textarea id="content" rows="9" class="mt-1 block w-full" 
                        placeholder="{{ __('Write your thoughts here...') }}" wire:model.defer="content" />
                    <x-input-error for="content" class="mt-2" />
                </div>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t">
                <x-button type="submit" wire:loading.attr="disabled">
                    {{ __('Post') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
