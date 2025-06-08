<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Festival Einstellungen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.festival.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="aufbau_start" value="{{ __('Aufbau Start') }}" />
                            <x-text-input type="date" id="aufbau_start" name="aufbau_start" :value="$festival->aufbau_start?->format('Y-m-d')" required class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="festival_start" value="{{ __('Festival Start') }}" />
                            <x-text-input type="date" id="festival_start" name="festival_start" :value="$festival->festival_start?->format('Y-m-d')" required class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="abbau_start" value="{{ __('Abbau Start') }}" />
                            <x-text-input type="date" id="abbau_start" name="abbau_start" :value="$festival->abbau_start?->format('Y-m-d')" required class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="abbau_end" value="{{ __('Abbau Ende') }}" />
                            <x-text-input type="date" id="abbau_end" name="abbau_end" :value="$festival->abbau_end?->format('Y-m-d')" required class="mt-1 block w-full" />
                        </div>
                    </div>
                    <x-primary-button class="mt-4">{{ __('Speichern') }}</x-primary-button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-calendar :festival="$festival" :workdays="$workdays" />
            </div>
        </div>
    </div>
</x-app-layout>
