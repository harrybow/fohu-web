<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function edit()
    {
        $festival = Festival::first();
        if (! $festival) {
            $aufbauStart = now()->startOfMonth();
            $festivalStart = now()->startOfMonth()->addDays(3);
            $abbauStart = now()->startOfMonth()->addDays(6);
            $abbauEnd = now()->startOfMonth()->addDays(7);

            $festival = Festival::create([
                'aufbau_start' => $aufbauStart,
                'festival_start' => $festivalStart,
                'abbau_start' => $abbauStart,
                'abbau_end' => $abbauEnd,
                'aufbau_end' => $festivalStart,
                'festival_end' => $abbauStart->copy()->subDay(),
            ]);
        }

        return view('admin.festival.edit', compact('festival'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'aufbau_start' => 'required|date',
            'festival_start' => 'required|date|after_or_equal:aufbau_start',
            'abbau_start' => 'required|date|after:festival_start',
            'abbau_end' => 'required|date|after_or_equal:abbau_start',
        ]);

        $data['aufbau_end'] = Carbon::parse($data['festival_start']);
        $data['festival_end'] = Carbon::parse($data['abbau_start'])->subDay();

        $festival = Festival::first();
        $festival->update($data);

        return redirect()->route('admin.festival.edit')->with('success', 'Kalender gespeichert.');
    }
}
