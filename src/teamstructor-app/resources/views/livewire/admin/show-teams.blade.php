<div>
    <x-slot name="header">
        {{ Breadcrumbs::render('admin-teams') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-900">
                {{ __('Manage Teams') }}
            </h2>
            <p class="mt-2 mb-4 text-gray-500 text-sm leading-relaxed">
                {{ __('Teams created by your application users are displayed below. You can check details for each team - name, team owner, team members, whether it is a personal team, time of creation and projects that belong to the team.') }}
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-12">
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <x-input id="search" wire:model="search" type="search" class="mt-1 block w-full md:w-1/2"
                            placeholder="{{ __('Search teams by name...') }}" />

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
                                        {{ __('Team Owner') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Members') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Personal') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Created At') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Projects') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                            <a href="{{ route('teams.show', ['team' => $team]) }}"
                                                class="text-base font-semibold">
                                                <p>{{ $team->name }}</p>
                                            </a>
                                        </th>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center font-medium whitespace-nowrap">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ $team->owner->profile_photo_url }}"
                                                    alt="{{ $team->owner->name }}">
                                                <div class="pl-3">
                                                    <div class="text-gray-900">{{ $team->owner->name }}</div>
                                                    <div class="text-gray-500">{{ $team->owner->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach ($team->users as $member)
                                                <div class="flex items-center whitespace-nowrap py-2">
                                                    <img class="w-6 h-6 rounded-full"
                                                        src="{{ $member->profile_photo_url }}"
                                                        alt="{{ $member->name }}">
                                                    <div class="pl-3">
                                                        <div class="text-gray-900">{{ $member->name }}</div>
                                                        <div class="text-gray-500">{{ $member->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-2.5 w-2.5 rounded-full mr-2 
                                        {{ $team->personal_team ? 'bg-green-500' : 'bg-red-500' }}">
                                                </div>
                                                {{ $team->personal_team ? __('Yes') : __('No') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p>{{ $team->created_at->format('d.m.Y. H:i:s') }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach ($team->projects as $project)
                                                <a
                                                    href="{{ route('teams.projects.discussion', ['team' => $team, 'project' => $project]) }}">
                                                    <p>{{ $project->name }}</p>
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-50">
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
