<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Visit extends Model
{
    use HasFactory;
    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'visit_service');
    }
}
