<div>
    <article class="p-6 mb-6 text-base bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                    <img class="mr-2 w-6 h-6 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}"
                        alt="{{ $comment->user->name }}">{{ $comment->user->name }}
                </p>
                <p class="mr-3 text-sm text-gray-600 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                @if ($comment->updated_at != $comment->created_at)
                    <p class="text-sm text-gray-400 dark:text-gray-500">{{ __('Edited') }}</p>
                @endif
            </div>
            @canany(['update', 'delete'], $comment)
                <button id="dropdownComment{{ $comment->id }}Button"
                    data-dropdown-toggle="dropdownComment{{ $comment->id }}"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                        </path>
                    </svg>
                    <span class="sr-only">{{ __('Comment Settings') }}</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownComment{{ $comment->id }}"
                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        @can('update', $comment)
                            <li>
                                <a href="#" wire:click.prevent="edit({{ $comment->id }})"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edit') }}</a>
                            </li>
                        @endcan
                        @can('delete', $comment)
                            <li>
                                <a href="#" wire:click.prevent="delete({{ $comment->id }})"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Delete') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
    </article>

    <x-dialog-modal wire:model="openEditModal">
        <x-slot name="title">
            {{ __('Comment Information') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="content" value="{{ __('Content') }}" />
                <textarea id="content" rows="3"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    wire:model.defer="content">
                </textarea>
                <x-input-error for="content" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('openEditModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model="openDeleteModal">
        <x-slot name="title">
            {{ __('Delete Comment') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete comment?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('openDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete Comment') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
