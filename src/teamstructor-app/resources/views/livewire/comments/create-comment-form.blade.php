<div class="w-full">
    <form wire:submit.prevent="store">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-lg">
                <textarea id="content" rows="4"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    placeholder="{{ __('Write your thoughts here...') }}" wire:model.defer="content"></textarea>
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
