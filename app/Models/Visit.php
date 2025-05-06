<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['barber_id', 'start_at'];

    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'visit_service');
    }

    public function barber(): BelongsTo
    {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
