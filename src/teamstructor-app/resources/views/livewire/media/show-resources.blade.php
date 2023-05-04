<div>
    <x-slot name="header">
        {{ Breadcrumbs::render('resources', $project->team, $project) }}
    </x-slot>

    @forelse ($resources as $resource)
        {{ $resource->getFullUrl() }}
    @empty
        {{ __('There are no resources yet in this project. Start uploading!') }}
    @endforelse
</div>
