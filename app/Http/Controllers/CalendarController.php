<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(string $barber_id)
    {
        $nearestVisits = User::barberNearestVisits($barber_id);

        return view('pick_date',[
            'visits' => $nearestVisits,
            'barber' => User::find($barber_id)
        ]);
    }

    public function json(string $barberId)
    {
        $barber = User::findOrFail($barberId);

        $dates = $barber->visits()
            ->whereNull('user_id')
            ->where('start_at', '>', now())
            ->get()
            ->groupBy(fn($visit) => $visit->start_at->toDateString())
            ->keys()
            ->map(fn($date) => [
                'start' => $date,
                'display' => 'background',
                'allDay' => true,
            ]);

        return response()->json($dates);
    }

    public function visitsOnDate($barber_id, Request $request)
    {
        $date = $request->query('date');

        $barber = User::findOrFail($barber_id);

        $visits = $barber->visits()
            ->whereNull('user_id')
            ->whereDate('start_at', $date)
            ->orderBy('start_at')
            ->get();

        return response()->json([
            'date' => $date,
            'visits' => $visits->map(fn($v) => [
                'id' => $v->id,
                'time' => Carbon::parse($v->start_at)->format('H:i'),
            ]),
        ]);
    }
}
