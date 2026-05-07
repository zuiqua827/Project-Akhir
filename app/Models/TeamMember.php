<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'role', 'image', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}
