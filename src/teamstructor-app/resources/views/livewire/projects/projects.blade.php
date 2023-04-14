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
                        {{ $team->name }}
                    </span>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span
                            class="inline-flex items-center ml-1 text-xl font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z">
                                </path>
                            </svg>
                            {{ __('Projects') }}
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
                {{ __('Add Project') }}
            </x-button>


            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($projects as $project)
                    <div
                        class="h-auto max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a
                            href="{{ route('teams.projects.show', ['team' => $project->team_id, 'project' => $project->id]) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $project->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $project->description }}</p>
                        <a href="{{ route('teams.projects.show', ['team' => $project->team_id, 'project' => $project->id]) }}"
                            class="inline-flex items-center mt-3 font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                            {{ __('Show Project') }}
                            <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <div class="flex mt-3 mb-3">
                            <x-secondary-button wire:click="edit({{ $project->id }})" wire:loading.attr="disabled">
                                {{ __('Edit Project') }}
                            </x-secondary-button>
                            <x-danger-button class="ml-2" wire:click="confirmDeletion({{ $project->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Delete Project') }}
                            </x-danger-button>
                        </div>
                    </div>
                @empty
                    <p>{{ __('There are no projects in this team yet. Go create one!') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="creatingOrEditingProject">
        <x-slot name="title">
            {{ __('Project Information') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <textarea id="description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    wire:model.defer="description">
            </textarea>
                <x-input-error for="description" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('creatingOrEditingProject')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model="confirmingProjectDeletion">
        <x-slot name="title">
            {{ __('Delete Project') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete project?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingProjectDeletion')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Project') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
