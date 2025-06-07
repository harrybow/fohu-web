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
                @endphp
                <td class="border p-1 {{ $classes }}">{{ $day->format('d.m.') }}</td>
            @endforeach
        </tr>
    </tbody>
</table>
</div>
