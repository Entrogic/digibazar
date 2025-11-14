<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSection extends Model
{
    protected $fillable = ['title', 'order'];

    public function components()
    {
        return $this->hasMany(LandingComponent::class)->orderBy('order');
    }
}
