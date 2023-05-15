<div>
    <x-slot name="header">
        {{ Breadcrumbs::render('resources', $project->team, $project) }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('media.upload-resource', ['project' => $project], key($project->id))

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                @forelse ($resources as $resource)
                    @livewire('media.show-resource', ['resource' => $resource], key($resource->id))
                @empty
                    {{ __('There are no resources yet in this project. Start uploading!') }}
                @endforelse
            </div>
        </div>
    </div>
</div>
