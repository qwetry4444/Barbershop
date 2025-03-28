<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;
    public function visits(): BelongsToMany
    {
        return $this->belongsToMany(Visit::class, 'visit_service');
    }
}
