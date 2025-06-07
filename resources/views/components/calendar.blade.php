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
<table class="min-w-full border text-center">
    <thead>
        <tr>
            <th class="p-1">Mo</th>
            <th class="p-1">Di</th>
            <th class="p-1">Mi</th>
            <th class="p-1">Do</th>
            <th class="p-1">Fr</th>
            <th class="p-1">Sa</th>
            <th class="p-1">So</th>
        </tr>
    </thead>
    <tbody>
    @foreach($days as $i => $day)
        @if($i % 7 === 0)
            <tr>
        @endif
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
        @if($i % 7 === 6)
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
