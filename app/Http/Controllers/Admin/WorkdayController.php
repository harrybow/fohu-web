<?php

namespace App\Http\Controllers\Admin;

use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    public function index()
    {
        $workdays = Workday::orderBy('day')->get();
        return view('workdays.index', compact('workdays'));
    }

    public function signup(Workday $workday)
    {
        auth()->user()->workdays()->attach($workday->id);
        return back()->with('success', 'Du bist dabei! 🎉');
    }

    public function cancel(Workday $workday)
    {
        auth()->user()->workdays()->detach($workday->id);
        return back()->with('warning', 'Schade, dass du abspringst…');
    }
}
