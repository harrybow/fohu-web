<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meine Tage') }}
        </h2>
    </x-slot>

    @php
        $festival = \App\Models\Festival::first();
    @endphp

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($festival)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <x-calendar :festival="$festival" />
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(auth()->user()->hasRole('admin'))
                    <div class="overflow-x-auto">
                        <table class="min-w-max text-center">
                            <thead>
                                <tr>
                                    <th class="p-2 text-left">{{ __('Name') }}</th>
                                    @foreach($workdays as $day)
                                        <th class="p-2 whitespace-nowrap">{{ $day->day->format('d.m.') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $users = \App\Models\User::orderBy('name')->get();
                                @endphp
                                @foreach($users as $user)
                                    <tr class="border-t">
                                        <td class="p-2 text-left">{{ $user->name }}</td>
                                        @foreach($workdays as $day)
                                            @php
                                                $entry = optional($user->workdays->firstWhere('id', $day->id))->pivot->status;
                                            @endphp
                                            <td class="p-2 border">{{ $entry }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('Datum') }}</th>
                                <th class="text-left">{{ __('Titel') }}</th>
                                <th class="text-right">{{ __('Aktion') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workdays as $workday)
                                @php
                                    $current = optional($workday->users->firstWhere('id', auth()->id()))->pivot->status;
                                @endphp
                                <tr class="border-t">
                                    <td class="py-2">{{ $workday->day->format('d.m.Y') }}</td>
                                    <td class="py-2">{{ $workday->title }}</td>
                                    <td class="py-2 text-right space-x-1">
                                        @foreach(['A','0.5','1'] as $opt)
                                            <form method="POST" action="{{ route('workdays.signup', $workday) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ $opt }}">
                                                <x-primary-button :class="$current === $opt ? 'bg-green-500' : ''">{{ $opt }}</x-primary-button>
                                            </form>
                                        @endforeach
                                        @if($current)
                                            <form method="POST" action="{{ route('workdays.cancel', $workday) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-secondary-button>{{ __('Entfernen') }}</x-secondary-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
