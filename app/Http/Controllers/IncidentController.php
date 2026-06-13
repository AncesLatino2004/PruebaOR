<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\IncidentLog;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::orderBy('created_at', 'desc')->get();
        return view('incidents.index', compact('incidents'));
    }

    // Funcion crear incidencia
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $incident = Incident::create($data);

        IncidentLog::create([
            'incident_id' => $incident->id,
            'action' => 'created',
            'old_value' => null,
            'new_value' => 'status: ' . $incident->status,
        ]);

        return redirect()->route('incidents.index')->with('success', 'Incidencia creada.');
    }

    // Funcoin de editar inicidencia
    public function update(Request $request, Incident $incident)
    {
        $data = $request->validate([
            'status' => 'required|in:open,review,resolved',
        ]);

        $oldStatus = $incident->status;

        if ($oldStatus !== $data['status']) {
            $incident->update(['status' => $data['status']]);

            IncidentLog::create([
                'incident_id' => $incident->id,
                'action' => 'status_change',
                'old_value' => $oldStatus,
                'new_value' => $data['status'],
            ]);
        }

        return redirect()->route('incidents.index')->with('success', 'Estado actualizado.');
    }

    // Funcion de vista de historial

    public function logs(Incident $incident)
    {
        $logs = $incident->logs()->orderBy('created_at', 'desc')->get();
        return view('incidents.logs', compact('incident', 'logs'));
    }
}
