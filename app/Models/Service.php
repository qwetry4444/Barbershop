<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function visit(): BelongsToMany
    {
        return $this->belongsToMany(Visit::class, 'visit_service');
    }
}
