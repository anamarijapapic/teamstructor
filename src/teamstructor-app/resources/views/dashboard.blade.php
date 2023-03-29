<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="w-8 h-8 stroke-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <h1 class="ml-3 text-2xl font-medium text-gray-900">
                            {{ __('Explore your teams!') }}
                        </h1>
                    </div>

                    <div class="container mx-auto mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <div class="text-6xl rounded-xl p-6">
                                <h2 class="text-xl font-semibold text-gray-900">
                                    {{ __('Teams you own') }} ({{ auth()->user()->ownedTeams->count() }})
                                </h2>
                                <div class="pt-5">
                                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach (auth()->user()->ownedTeams as $team)
                                            <li class="pb-3 sm:pb-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $team->name }}
                                                        </p>
                                                        <div class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            {{ __('Owner:') }}
                                                            <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                                                src="{{ $team->owner->profile_photo_url }}"
                                                                title="{{ $team->owner->name }}" alt="">
                                                            {{ __('Members:') }}
                                                            <div class="flex -space-x-4">
                                                                @forelse ($team->users as $member)
                                                                    <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                                                        src="{{ $member->profile_photo_url }}"
                                                                        title="{{ $member->name }}" alt="">
                                                                @empty
                                                                    <p
                                                                        class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        {{ __('No members yet!') }}
                                                                    </p>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-button class="mt-2 mr-2" type="button">
                                                        {{ __('Show projects') }}
                                                    </x-button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-gray-200 bg-opacity-25 text-6xl rounded-xl p-6">
                                <h2 class="text-xl font-semibold text-gray-900">
                                    {{ __('Teams you belong to') }} ({{ auth()->user()->teams->count() }})
                                </h2>

                                <div class="pt-5">
                                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach (auth()->user()->teams as $team)
                                            <li class="pb-3 sm:pb-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $team->name }}
                                                        </p>
                                                        <div class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            {{ __('Owner:') }}
                                                            <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                                                src="{{ $team->owner->profile_photo_url }}"
                                                                title="{{ $team->owner->name }}" alt="">
                                                            {{ __('Members:') }}
                                                            <div class="flex -space-x-4">
                                                                @forelse ($team->users as $member)
                                                                    <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                                                        src="{{ $member->profile_photo_url }}"
                                                                        title="{{ $member->name }}" alt="">
                                                                @empty
                                                                    <p
                                                                        class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        {{ __('No members yet!') }}
                                                                    </p>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-button class="mt-2 mr-2" type="button">
                                                        {{ __('Show projects') }}
                                                    </x-button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
