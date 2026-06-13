<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incident;
use App\Models\IncidentLog;

class IncidentSeeder extends Seeder
{
    public function run(): void
    {
        // Incidencia de inicio sesion
        $incident1 = Incident::create([
            'title' => 'Error en login',
            'description' => 'No se puede iniciar sesión',
            'status' => 'resolved',
            'priority' => 'high',
        ]);

        IncidentLog::create([
            'incident_id' => $incident1->id,
            'action' => 'status_change',
            'old_value' => 'open',
            'new_value' => 'resolved',
        ]);

        // Incidencia inconsistente: problema raton
        Incident::create([
            'title' => 'No funciona el raton',
            'description' => 'No me funciona el raton, solicito uno de recambio',
            'status' => 'resolved',
            'priority' => 'medium',
        ]);
    }
}
