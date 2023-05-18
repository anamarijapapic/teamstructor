<div>
    <div class="h-auto max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <a href="{{ route('teams.projects.discussion', ['team' => $project->team_id, 'project' => $project->id]) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                {{ $project->name }}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700">{{ $project->description }}</p>
        <a href="{{ route('teams.projects.discussion', ['team' => $project->team_id, 'project' => $project->id]) }}"
            class="inline-flex items-center mt-3 font-medium text-blue-600 hover:text-blue-800">
            {{ __('Show Project') }}
            <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <div class="flex mt-3 mb-3">
            @can('update', $project)
                <x-secondary-button wire:click="edit({{ $project->id }})" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                        </path>
                    </svg>
                    {{ __('Edit') }}
                </x-secondary-button>
            @endcan
            @can('delete', $project)
                <x-danger-button class="ml-2" wire:click="delete({{ $project->id }})" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                        </path>
                    </svg>
                    {{ __('Delete') }}
                </x-danger-button>
            @endcan
        </div>
    </div>

    <x-dialog-modal wire:model="openEditModal">
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
                <x-textarea id="description" rows="3" class="mt-1 block w-full" wire:model.defer="description" />
                <x-input-error for="description" class="mt-2" />
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
            {{ __('Delete Project') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete project?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('openDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete Project') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
