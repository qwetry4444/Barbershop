<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Collection\Collection;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $hidden = [
        'password',
        'remember_token'
    ];



    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'barber_id');
    }

    public static function barbers()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'barber');
        })->get();
    }

    public static function clients()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'client');
        })->get();
    }

    public function nearestVisits(): \Illuminate\Support\Collection
    {
        $futureFreeVisits = $this->visits()
            ->where('start_at', '>', now())
            ->whereNull('user_id')
            ->orderBy('start_at')
            ->get();

        if ($futureFreeVisits->isEmpty()) {
            return collect();
        }

        $nearestDateDay = $futureFreeVisits->first()->start_at->startOfDay();

        return $futureFreeVisits->filter(function ($visit) use ($nearestDateDay) {
            return $visit->start_at->startOfDay() == $nearestDateDay;
        })->values();
    }

    public static function barberNearestVisits(string $barber_id): \Illuminate\Support\Collection
    {
        $barber = self::find($barber_id);
        return $barber ? $barber->nearestVisits() : collect();
    }
}
