<?php

namespace App\Http\Controllers;

use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    /**
     * Display a listing of available workdays.
     */
    public function index()
    {
        $workdays = Workday::orderBy('day')->get();

        return view('workdays.index', compact('workdays'));
    }

    /**
     * Sign the authenticated user up for a workday.
     */
    public function signup(Workday $workday)
    {
        auth()->user()->workdays()->attach($workday->id);

        return back()->with('success', 'Du bist dabei! 🎉');
    }

    /**
     * Cancel the authenticated user's participation for a workday.
     */
    public function cancel(Workday $workday)
    {
        auth()->user()->workdays()->detach($workday->id);

        return back()->with('warning', 'Schade, dass du abspringst…');
    }
}
