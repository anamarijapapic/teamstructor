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
                    @livewire('projects.show-project', ['project' => $project], key($project->id))
                @empty
                    <p>{{ __('There are no projects in this team yet. Go create one!') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="openCreateModal">
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
            <x-secondary-button wire:click="$toggle('openCreateModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
