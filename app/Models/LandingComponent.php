<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingComponent extends Model
{
    protected $fillable = ['section_id', 'type', 'settings', 'order'];

    protected $casts = [
        'settings' => 'array', // automatically decode JSON
    ];

    public function section()
    {
        return $this->belongsTo(LandingSection::class);
    }
}
