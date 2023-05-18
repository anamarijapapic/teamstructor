<div class="w-full">
    <form wire:submit.prevent="store">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-lg">
                <x-textarea id="content" rows="4" class="mt-1 block w-full"
                    placeholder="{{ __('Write your thoughts here...') }}" wire:model.defer="content" />
                <x-input-error for="content" class="mt-2" />
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t">
                <x-button type="submit" wire:loading.attr="disabled">
                    {{ __('Comment') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
