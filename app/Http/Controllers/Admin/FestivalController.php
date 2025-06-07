<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Festival;

class FestivalController extends Controller
{
    public function edit()
    {
        $festival = Festival::first();
        if (!$festival) {
            $festival = Festival::create([
                'aufbau_start' => now()->startOfMonth(),
                'aufbau_end' => now()->startOfMonth()->addDays(2),
                'festival_start' => now()->startOfMonth()->addDays(3),
                'festival_end' => now()->startOfMonth()->addDays(5),
                'abbau_start' => now()->startOfMonth()->addDays(6),
                'abbau_end' => now()->startOfMonth()->addDays(7),
            ]);
        }

        return view('admin.festival.edit', compact('festival'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'aufbau_start' => 'required|date',
            'aufbau_end' => 'required|date',
            'festival_start' => 'required|date',
            'festival_end' => 'required|date',
            'abbau_start' => 'required|date',
            'abbau_end' => 'required|date',
        ]);

        $festival = Festival::first();
        $festival->update($data);

        return redirect()->route('admin.festival.edit')->with('success', 'Kalender gespeichert.');
    }
}
