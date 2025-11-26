<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'image',
        'status',
    ];

    /**
     * Get the full URL for the unit image
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Scope a query to only include active units.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
