<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1>Historial de: {{ $incident->title }}</h1>
    <a href="{{ route('incidents.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Acción</th>
            <th>Valor anterior</th>
            <th>Valor nuevo</th>
        </tr>
        </thead>
        <tbody>
        @forelse($logs as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->old_value }}</td>
                <td>{{ $log->new_value }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Sin registros.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
