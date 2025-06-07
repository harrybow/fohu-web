<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    public function index()
    {
        $workdays = Workday::orderBy('day')->get();

        return view('workdays.index', compact('workdays'));
    }

    public function signup(Request $request, Workday $workday)
    {
        $data = $request->validate([
            'status' => ['required', 'in:A,0.5,1'],
        ]);
        auth()->user()->workdays()->syncWithoutDetaching([
            $workday->id => ['status' => $data['status']],
        ]);

        return back()->with('success', 'Du bist dabei! 🎉');
    }

    public function cancel(Workday $workday)
    {
        auth()->user()->workdays()->detach($workday->id);

        return back()->with('warning', 'Schade, dass du abspringst…');
    }
}
