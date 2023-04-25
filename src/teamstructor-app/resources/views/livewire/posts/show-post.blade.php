<div class="w-full">
    <article
        class="pt-6 pb-8 lg:pt-12 lg:pb-12 mx-auto mb-6 w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <header class="mb-4 lg:mb-6 not-format">
            <button id="dropdownPost{{ $post->id }}Button" data-dropdown-toggle="dropdownPost{{ $post->id }}"
                class="inline-flex items-center float-right p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
                <span class="sr-only">{{ __('Post Settings') }}</span>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownPost{{ $post->id }}"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#" wire:click.prevent="edit({{ $post->id }})"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edit') }}</a>
                    </li>
                    <li>
                        <a href="#" wire:click.prevent="delete({{ $post->id }})"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Delete') }}</a>
                    </li>
                </ul>
            </div>
            <address class="flex items-center mb-6 not-italic">
                <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                    <img class="mr-4 w-16 h-16 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}"
                        alt="{{ $post->user->name }}">
                    <div>
                        <a href="#" rel="author"
                            class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</a>
                        <p class="text-base font-light text-gray-500 dark:text-gray-400">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </address>
            <h1 class="mb-4 text-2xl font-semibold text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                {{ $post->title }}
            </h1>
        </header>
        <p class="lg:my-8 my-4 text-lg">
            {{ $post->content }}
        </p>
        <section class="not-format">
            @livewire('comments.show-comments', ['post' => $post], key($post->id))
        </section>
    </article>

    <x-dialog-modal wire:model="openEditModal">
        <x-slot name="title">
            {{ __('Post Information') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                <x-input-error for="title" class="mt-2" />
            </div>

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
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete post?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('openDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete Post') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
