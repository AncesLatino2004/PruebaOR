<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


// Modelo de el historial de la incidencia

class IncidentLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['incident_id', 'action', 'old_value', 'new_value'];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
