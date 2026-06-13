<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo de la incidencia

class Incident extends Model
{
    protected $fillable = ['title', 'description', 'status', 'priority'];

    public function logs()
    {
        return $this->hasMany(IncidentLog::class);
    }
}

