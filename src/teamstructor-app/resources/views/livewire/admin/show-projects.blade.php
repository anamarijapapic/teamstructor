<div>
    <x-slot name="header">
        {{ Breadcrumbs::render('admin-projects') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-900">
                {{ __('Manage Projects') }}
            </h2>
            <p class="mt-2 mb-4 text-gray-500 text-sm leading-relaxed">
                {{ __('Projects created inside existing teams are displayed below. You can check details for each project - name, description, project creator, creation date, team it belongs to. You can also check project discussion and uploaded resources.') }}
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-12">
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <x-input id="search" wire:model="search" type="search" class="mt-1 block w-full md:w-1/2"
                            placeholder="{{ __('Search projects by name...') }}" />

                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ __('Results per page: ') . $perPage }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="w-60">
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Results per page') }}
                                            </div>

                                            <x-dropdown-link wire:click="$set('perPage', 5)">
                                                5
                                            </x-dropdown-link>

                                            <x-dropdown-link wire:click="$set('perPage', 10)">
                                                10
                                            </x-dropdown-link>

                                            <x-dropdown-link wire:click="$set('perPage', 20)">
                                                20
                                            </x-dropdown-link>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Description') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Creator') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Created At') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Team') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Discussion & Resources') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                            <p class="text-base font-semibold">{{ $project->name }}</p>
                                        </th>
                                        <td class="px-6 py-4">
                                            <p>{{ $project->description }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center font-medium whitespace-nowrap">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ $project->user->profile_photo_url }}"
                                                    alt="{{ $project->user->name }}">
                                                <div class="pl-3">
                                                    <div class="text-gray-900">{{ $project->user->name }}</div>
                                                    <div class="text-gray-500">{{ $project->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p>{{ $project->created_at->format('d.m.Y. H:i:s') }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('teams.show', ['team' => $project->team]) }}"
                                                class="text-base font-semibold">
                                                <p>{{ $project->team->name }}</p>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('teams.projects.discussion', ['team' => $project->team, 'project' => $project]) }}"
                                                class="inline-flex items-center font-semibold text-indigo-700"
                                                title="{{ __('Discussion') }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="ml-1 w-5 h-5 fill-indigo-500">
                                                    <path
                                                        d="M3.505 2.365A41.369 41.369 0 019 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 00-.577-.069 43.141 43.141 0 00-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 015 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914z">
                                                    </path>
                                                    <path
                                                        d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 001.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0014 6z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('teams.projects.resources', ['team' => $project->team, 'project' => $project]) }}"
                                                class="inline-flex items-center font-semibold text-indigo-700"
                                                title="{{ __('Resources') }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="ml-1 w-5 h-5 fill-indigo-500">
                                                    <path
                                                        d="M7 3.5A1.5 1.5 0 018.5 2h3.879a1.5 1.5 0 011.06.44l3.122 3.12A1.5 1.5 0 0117 6.622V12.5a1.5 1.5 0 01-1.5 1.5h-1v-3.379a3 3 0 00-.879-2.121L10.5 5.379A3 3 0 008.379 4.5H7v-1z">
                                                    </path>
                                                    <path
                                                        d="M4.5 6A1.5 1.5 0 003 7.5v9A1.5 1.5 0 004.5 18h7a1.5 1.5 0 001.5-1.5v-5.879a1.5 1.5 0 00-.44-1.06L9.44 6.439A1.5 1.5 0 008.378 6H4.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-50">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
