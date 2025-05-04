<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 2;
        return view('barbers', [
            'barbers' => User::paginate($perpage)->withQueryString()
        ]);
    }
    public function show(string $id)
    {
        return view('barber', [
            'barber' => User::all()->where('id', $id)->first()
        ]);
    }
}
