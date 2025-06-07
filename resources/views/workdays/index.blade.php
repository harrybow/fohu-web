<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meine Tage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">{{ __('Datum') }}</th>
                            <th class="text-left">{{ __('Titel') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workdays as $workday)
                            <tr class="border-t">
                                <td class="py-2">{{ $workday->day->format('d.m.Y') }}</td>
                                <td class="py-2">{{ $workday->title }}</td>
                                <td class="py-2 text-right">
                                    @if($workday->users->contains(auth()->user()))
                                        <form method="POST" action="{{ route('workdays.cancel', $workday) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button>{{ __('Absagen') }}</x-primary-button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('workdays.signup', $workday) }}">
                                            @csrf
                                            <x-primary-button>{{ __('Anmelden') }}</x-primary-button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
