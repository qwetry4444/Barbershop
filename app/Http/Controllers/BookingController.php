<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function chooseBarber()
    {
        $barbers = User::barbers();
        return view('pick_barber', ['barbers' => $barbers]);
    }

    public function postBarber(Request $request)
    {
        $request->validate(['barber_id' => 'required|exists:users,id']);
        session(['booking.barber_id' => $request->barber_id]);
        return redirect()->intended('booking/service');
    }

    public function chooseService()
    {
        $services = Service::all();
        return view('pick_service', ['services' => $services]);
    }

    public function postService(Request $request)
    {
        $request->validate(['service_id' => 'required|exists:services,id']);
        session(['booking.service_id' => $request->service_id]);
        return redirect()->intended('booking/time');
    }

    public function chooseTime()
    {
        $barberId = session('booking.barber_id');
        $serviceId = session('booking.service_id');

        $barber = User::find($barberId);
        $availableVisits = Visit::where('barber_id', $barberId)
            ->whereNull('user_id')
            ->where('start_at', '>', now())
            ->orderBy('start_at')
            ->get();

        return view('pick_time', ['barber' => $barber]);
    }

    public function postTime(Request $request)
    {

        $request->validate(['visit_id' => 'required|exists:visits,id']);
        session(['booking.visit_id' => $request->visit_id]);
        return redirect()->intended('booking/confirm');
    }

    public function confirm()
    {
        $barber = User::find(session('booking.barber_id'));
        $service = Service::find(session('booking.service_id'));
        $visit = Visit::find(session('booking.visit_id'));

        return view('booking_confirm', ['barber' => $barber, 'service' => $service, 'visit' => $visit]);
    }

    public function postConfirm()
    {
        $visit = Visit::find(session('booking.visit_id'));
        if ($visit != null) {
            $visit->user_id = auth()->id();
            $visit->save();
        }


        session()->forget('booking');

        return redirect()->intended('booking/barber')->with('success', 'Вы успешно записаны!');
    }
}
