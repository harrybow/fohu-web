@props(['festival'])
@php
    $start = collect([
        $festival->aufbau_start,
        $festival->festival_start,
        $festival->abbau_start
    ])->filter()->min();
    $end = collect([
        $festival->aufbau_end,
        $festival->festival_end,
        $festival->abbau_end
    ])->filter()->max();
    $periodStart = \Carbon\Carbon::parse($start)->startOfWeek(1);
    $periodEnd = \Carbon\Carbon::parse($end)->endOfWeek(0);
    $days = [];
    $current = $periodStart->clone();
    while($current <= $periodEnd){
        $days[] = $current->clone();
        $current->addDay();
    }
@endphp
<div class="overflow-x-auto">
<table class="min-w-max border text-center">
    <thead>
        <tr>
            @foreach($days as $day)
                <th class="p-1">{{ $day->locale('de')->isoFormat('dd') }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($days as $day)
                @php
                    $classes = '';
                    if($day->between($festival->aufbau_start, $festival->aufbau_end)){
                        $classes = 'bg-yellow-200';
                    }
                    if($day->between($festival->festival_start, $festival->festival_end)){
                        $classes = 'bg-green-200';
                    }
                    if($day->between($festival->abbau_start, $festival->abbau_end)){
                        $classes = 'bg-red-200';
                    }

                    $workday = \App\Models\Workday::where('day', $day->toDateString())->first();
                    $current = optional($workday?->users->firstWhere('id', auth()->id()))->pivot->status;
                @endphp
                <td class="border p-1 space-y-1 {{ $classes }}">
                    {{ $day->format('d.m.') }}
                    @if($workday)
                        <div class="flex justify-center space-x-1 flex-wrap">
                            @foreach(['A','0.5','1'] as $opt)
                                <form method="POST" action="{{ route('workdays.signup', $workday) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $opt }}">
                                    <x-primary-button class="text-xs px-2 py-1 {{ $current === $opt ? 'ring-2 ring-black' : '' }}">{{ $opt }}</x-primary-button>
                                </form>
                            @endforeach
                            @if($current)
                                <form method="POST" action="{{ route('workdays.cancel', $workday) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button class="text-xs px-2 py-1">{{ __('Entfernen') }}</x-secondary-button>
                                </form>
                            @endif
                        </div>
                    @endif
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
</div>
