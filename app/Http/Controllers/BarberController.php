<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        return view('barbers', [
            'barbers' => Barber::all()
        ]);
    }
    public function show(string $id)
    {
        return view('barber', [
            'barber' => Barber::all()->where('id', $id)->first()
        ]);
    }
}
