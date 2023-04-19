<div>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <span
                        class="inline-flex items-center text-xl font-medium text-gray-700 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z">
                            </path>
                        </svg>
                        {{ $project->team->name }}
                    </span>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('teams.projects', ['team' => $project->team]) }}"
                            class="inline-flex items-center ml-1 text-xl font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z">
                                </path>
                            </svg>
                            {{ __('Projects') }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-xl font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                            {{ $project->name }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="mb-4" wire:click="create">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z">
                    </path>
                </svg>
                {{ __('Add Post') }}
            </x-button>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <form>
                            <div class="mt-4">
                                <x-label for="title" value="{{ __('Title') }}" />
                                <x-input id="title" type="text" class="mt-1 block w-full"
                                    placeholder="Start a discussion with {{ $project->team->name }}"
                                    wire:model.defer="title" />
                                <x-input-error for="title" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-label for="content" value="{{ __('Content') }}" />
                                <textarea id="content" rows="9"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="What's on your mind..." wire:model.defer="content">
                                    </textarea>
                                <x-input-error for="content" class="mt-2" />
                            </div>
                            <x-button wire:click="store" wire:loading.attr="disabled">
                                {{ __('Post') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                            <div class="flex flex-col items-center">
                                <form class="mb-6">
                                    <div class="mt-4">
                                        <x-label for="title" value="{{ __('Title') }}" />
                                        <x-input id="title" type="text" class="mt-1 block w-full"
                                            placeholder="Start a discussion with {{ $project->team->name }}"
                                            wire:model.defer="title" />
                                        <x-input-error for="title" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-label for="content" value="{{ __('Content') }}" />
                                        <textarea id="content" rows="9"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="What's on your mind..." wire:model.defer="content">
                                            </textarea>
                                        <x-input-error for="content" class="mt-2" />
                                    </div>
                                    <x-button class="mb-6" wire:click="store" wire:loading.attr="disabled">
                                        {{ __('Post') }}
                                    </x-button>
                                </form>

                                @forelse($posts as $post)
                                    <article
                                        class="mx-auto mb-6 w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                                        <header class="mb-4 lg:mb-6 not-format">
                                            <address class="flex items-center mb-6 not-italic">
                                                <div
                                                    class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                                    <img class="mr-4 w-16 h-16 rounded-full"
                                                        src="{{ $post->user->profile_photo_url }}"
                                                        alt="{{ $post->user->name }}">
                                                    <div class="ml-4">
                                                        <a href="#" rel="author"
                                                            class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</a>
                                                        <p
                                                            class="text-base font-light text-gray-500 dark:text-gray-400">
                                                            {{ $post->created_at }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </address>
                                            <h1
                                                class="mb-4 text-2xl font-semibold text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                                                {{ $post->title }}
                                            </h1>
                                        </header>
                                        <p>
                                            {{ $post->content }}
                                        </p>
                                        <section class="not-format">
                                            <div class="flex justify-between items-center mb-6">
                                                <h2
                                                    class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">
                                                    {{ __('Comments') }} ({{ $post->comments->count() }})</h2>
                                            </div>
                                            <form class="mb-6">
                                                <div class="mt-4">
                                                    <x-label for="comment" value="{{ __('Your comment') }}" />
                                                    <textarea id="comment" rows="3"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder="Leave a comment..." wire:model.defer="comment">
                                                    </textarea>
                                                    <x-input-error for="comment" class="mt-2" />
                                                </div>
                                                <button type="submit"
                                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                    {{ __('Comment') }}
                                                </button>
                                            </form>
                                            <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                                                <footer class="flex justify-between items-center mb-2">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                                            <img class="mr-2 w-6 h-6 rounded-full"
                                                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                                                alt="Michael Gough">Michael Gough
                                                        </p>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time
                                                                pubdate datetime="2022-02-08"
                                                                title="February 8th, 2022">Feb. 8,
                                                                2022</time></p>
                                                    </div>
                                                    <button id="dropdownComment1Button"
                                                        data-dropdown-toggle="dropdownComment1"
                                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                        type="button">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Comment settings</span>
                                                    </button>
                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownComment1"
                                                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownMenuIconHorizontalButton">
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </footer>
                                                <p>Very straight-to-point article. Really worth time reading. Thank you!
                                                    But
                                                    tools are just the
                                                    instruments for the UX designers. The knowledge of the design tools
                                                    are
                                                    as important as the
                                                    creation of the design strategy.</p>
                                            </article>
                                        </section>
                                    </article>
                                @empty
                                    <p>{{ __('There are no posts in this project yet. Start a discussion!') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($posts as $post)
                    <div
                        class="h-auto max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->content }}</p>
                        <div class="flex mt-3 mb-3">
                            <x-secondary-button wire:click="edit({{ $post->id }})" wire:loading.attr="disabled">
                                {{ __('Edit Post') }}
                            </x-secondary-button>
                            <x-danger-button class="ml-2" wire:click="confirmDeletion({{ $post->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Delete Post') }}
                            </x-danger-button>
                        </div>
                    </div>
                @empty
                    <p>{{ __('There are no posts in this project yet. Start a discussion!') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="creatingOrEditingPost">
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
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    wire:model.defer="content">
                </textarea>
                <x-input-error for="content" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('creatingOrEditingPost')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model="confirmingPostDeletion">
        <x-slot name="title">
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete post?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingPostDeletion')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Post') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
