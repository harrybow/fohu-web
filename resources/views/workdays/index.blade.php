<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workdays') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Date') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Title') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Description') }}
                            </th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($workdays as $workday)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($workday->day)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $workday->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $workday->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(auth()->user()->workdays->contains($workday->id))
                                        <form action="{{ route('workdays.cancel', $workday) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                                        </form>
                                    @else
                                        <form action="{{ route('workdays.signup', $workday) }}" method="POST">
                                            @csrf
                                            <x-primary-button>{{ __('Sign up') }}</x-primary-button>
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
