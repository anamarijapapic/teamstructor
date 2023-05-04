<div>
    <x-slot name="header">
        {{ Breadcrumbs::render('projects', $team) }}
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
                            href="{{ route('teams.projects.discussion', ['team' => $project->team_id, 'project' => $project->id]) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $project->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $project->description }}</p>
                        <a href="{{ route('teams.projects.discussion', ['team' => $project->team_id, 'project' => $project->id]) }}"
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
                            @can('update', $project)
                                <x-secondary-button wire:click="edit({{ $project->id }})" wire:loading.attr="disabled">
                                    {{ __('Edit Project') }}
                                </x-secondary-button>
                            @endcan
                            @can('delete', $project)
                                <x-danger-button class="ml-2" wire:click="confirmDeletion({{ $project->id }})"
                                    wire:loading.attr="disabled">
                                    {{ __('Delete Project') }}
                                </x-danger-button>
                            @endcan
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
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
