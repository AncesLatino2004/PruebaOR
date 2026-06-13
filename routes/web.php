<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IncidentController;


Route::get('/', [IncidentController::class, 'index'])->name('incidents.index');
Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
Route::put('/incidents/{incident}', [IncidentController::class, 'update'])->name('incidents.update');
Route::delete('/incidents/{incident}', [IncidentController::class, 'destroy'])->name('incidents.destroy');

// Ruta historial
Route::get('/incidents/{incident}/logs', [IncidentController::class, 'logs'])->name('incidents.logs');
