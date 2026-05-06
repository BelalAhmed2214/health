<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                {{-- USERS --}}
                <div class="bg-black p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Users</h3>

                    <a href="{{ route('users.index') }}"
                       class="text-blue-600 hover:underline">
                        Manage Users
                    </a>
                </div>

                {{-- PATIENTS --}}
                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Patients</h3>

                    <a href="{{ route('patients.index') }}"
                       class="text-blue-600 hover:underline">
                        Manage Patients
                    </a>
                </div>

                {{-- VISITS --}}
                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Visits</h3>

                    <a href="{{ route('visits.index') }}"
                       class="text-blue-600 hover:underline">
                        Manage Visits
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>