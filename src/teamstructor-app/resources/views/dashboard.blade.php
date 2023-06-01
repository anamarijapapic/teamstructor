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
                    <x-application-logo class="block h-12 w-auto" />

                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        {{ __('Welcome to your Teamstructor application!') }}
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        {{ __('Teamstructor provides team management, team projects, project discussion & project resources.') }}
                        <br />
                        {{ __('To switch teams you can use the dropdown in upper right corner.') }}
                        <br />
                        {{ __('Inside each team you can find projects that you and other team members created. Inside each
                        project you can discuss relevant topics and project updates with other team members and browse
                        uploaded project resources. We hope you love it.') }}
                    </p>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                </path>
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                {{ __('My Teams') }}
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            {{ __('Check team settings and team members.') }}
                        </p>

                        @foreach (auth()->user()->allTeams() as $team)
                            <p class="mt-4 text-sm">
                                <a href="{{ route('teams.show', ['team' => $team]) }}"
                                    class="inline-flex items-center font-semibold text-indigo-700">
                                    {{ $team->name }}

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        class="ml-1 w-5 h-5 fill-indigo-500">
                                        <path fill-rule="evenodd"
                                            d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </p>
                        @endforeach
                    </div>

                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z">
                                </path>
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laracasts.com">{{ __('My Projects') }}</a>
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            {{ __('Explore your projects. Engage in project discussion by posting or commenting or browse shared project resources.') }}
                        </p>

                        @foreach (auth()->user()->allTeams() as $team)
                            <div class="mb-10">
                                <p class="mt-4 text-sm font-semibold">
                                    {{ $team->name }}
                                </p>

                                <p class="mt-4 text-sm">
                                    <a href="{{ route('teams.projects', ['team' => $team]) }}"
                                        class="inline-flex items-center font-semibold text-indigo-700">
                                        {{ __('All projects') }}

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            class="ml-1 w-5 h-5 fill-indigo-500">
                                            <path fill-rule="evenodd"
                                                d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </p>

                                @foreach ($team->projects as $project)
                                    <p class="mt-4 ml-3 text-sm">
                                        {{ $project->name }}

                                        <a href="{{ route('teams.projects.discussion', ['team' => $team, 'project' => $project]) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700"
                                            title="Discussion">

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

                                        <a href="{{ route('teams.projects.resources', ['team' => $team, 'project' => $project]) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700"
                                            title="Resources">

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
                                    </p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
