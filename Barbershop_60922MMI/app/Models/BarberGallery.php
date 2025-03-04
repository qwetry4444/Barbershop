<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberGallery extends Model
{
    use HasFactory;
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
