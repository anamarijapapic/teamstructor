<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Owned Teams') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Member Of') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Administrator') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\User::all() as $user)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                    <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}"
                                        alt="Jese image">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ $user->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    @foreach ($user->ownedTeams as $team)
                                        <a href="{{ route('teams.show', ['team' => $team]) }}">
                                            <p>{{ $team->name }}</p>
                                        </a>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($user->teams as $team)
                                        <a href="{{ route('teams.show', ['team' => $team]) }}">
                                            <p>
                                                {{ $team->name }}
                                            </p>
                                        </a>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-2.5 w-2.5 rounded-full mr-2 
                                            {{ $user->isAdministrator() ? 'bg-green-500' : 'bg-red-500' }}">
                                        </div>
                                        {{ $user->isAdministrator() ? 'Yes' : 'No' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">
                                        {{ __('Edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
