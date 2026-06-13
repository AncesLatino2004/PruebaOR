<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Incident;
use App\Models\IncidentLog;

class FixIncidentLogs extends Command
{
    protected $signature = 'incidents:fix-logs';
    protected $description = 'Corrige incidencias resueltas sin log asociado';

    
    public function handle(): int
    {
        $incidents = Incident::where('status', 'resolved')
            ->doesntHave('logs')
            ->get();

        foreach ($incidents as $incident) {
            IncidentLog::create([
                'incident_id' => $incident->id,
                'action' => 'status_fix_missing_log',
                'old_value' => null,
                'new_value' => 'resolved',
            ]);

            $this->info("Log creado para incidencia ID {$incident->id}");
        }

        return self::SUCCESS;
    }
}
