<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\User;
use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    /**
     * Display a listing of available workdays.
     */
    public function index()
    {
        $workdays = Workday::with('users')->orderBy('day')->get();
        $festival = Festival::first();
        $users = auth()->user()->hasRole('admin')
            ? User::with('workdays')->orderBy('name')->get()
            : collect();

        return view('workdays.index', compact('workdays', 'festival', 'users'));
    }

    /**
     * Sign the authenticated user up for a workday.
     */
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

    /**
     * Cancel the authenticated user's participation for a workday.
     */
    public function cancel(Workday $workday)
    {
        auth()->user()->workdays()->detach($workday->id);

        return back()->with('warning', 'Schade, dass du abspringst…');
    }
}
