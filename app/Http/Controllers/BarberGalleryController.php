<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\BarberGallery;
use App\Models\Visit;
use Illuminate\Http\Request;

class BarberGalleryController extends Controller
{
    public function index()
    {
        return view('barber_gallery', [
            'barber_gallery' => BarberGallery::all()
        ]);
    }
    public function show(string $id)
    {
        return view('barber_gallery', [
            'barber_gallery' => BarberGallery::all()->where('id', $id)->first()
        ]);
    }
}
