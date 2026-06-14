<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Panel de incidencias</h1>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Crear incidencia --}}
    <div class="card mb-4">
        <div class="card-header">Nueva incidencia</div>
        <div class="card-body">
            <form method="POST" action="{{ route('incidents.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prioridad</label>
                    <select name="priority" class="form-select">
                        <option value="low">Baja</option>
                        <option value="medium" selected>Media</option>
                        <option value="high">Alta</option>
                    </select>
                </div>
                <button class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>

    {{-- Traducciones --}}
    @php
        $statusLabels = [
            'open' => 'Abierta',
            'review' => 'En revisión',
            'resolved' => 'Resuelta',
        ];

        $priorityLabels = [
            'low' => 'Baja',
            'medium' => 'Media',
            'high' => 'Alta',
        ];
    @endphp

    {{-- Filtro --}}
    <div class="mb-3">
        <label class="form-label">Filtrar por estado:</label>
        <select id="statusFilter" class="form-select w-auto d-inline-block">
            <option value="">Todos</option>
            <option value="open">Abierta</option>
            <option value="review">En revisión</option>
            <option value="resolved">Resuelta</option>
        </select>
    </div>

    {{-- Contador por estado --}}
    <div class="mb-3">
        <span class="badge bg-secondary">Abiertas: <span id="count-open"></span></span>
        <span class="badge bg-warning text-dark">En revisión: <span id="count-review"></span></span>
        <span class="badge bg-success">Resueltas: <span id="count-resolved"></span></span>
    </div>

    {{-- Tabla de incidencias --}}
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Título</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="incidentsTable">
        @foreach($incidents as $incident)
            <tr data-status="{{ $incident->status }}">
                <td>{{ $incident->title }}</td>
                <td>
                    @php
                        $badge = match($incident->status) {
                            'open' => 'bg-secondary',
                            'review' => 'bg-warning text-dark',
                            'resolved' => 'bg-success',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $badge }}">
                        {{ $statusLabels[$incident->status] }}
                    </span>
                </td>
                <td>{{ $priorityLabels[$incident->priority] }}</td>
                <td>
                    {{-- Cambiar estado --}}
                    <form method="POST" action="{{ route('incidents.update', $incident) }}" class="d-inline change-status-form">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm d-inline w-auto">
                            <option value="open" @selected($incident->status === 'open')>Abierta</option>
                            <option value="review" @selected($incident->status === 'review')>En revisión</option>
                            <option value="resolved" @selected($incident->status === 'resolved')>Resuelta</option>
                        </select>
                        <button class="btn btn-sm btn-outline-primary">Actualizar</button>
                    </form>

                    {{-- Historial --}}
                    <a href="{{ route('incidents.logs', $incident) }}" class="btn btn-sm btn-outline-secondary">
                        Historial
                    </a>
                    <form action="{{ route('incidents.destroy', $incident->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres eliminar esta incidencia?');">
                   
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    const rows = document.querySelectorAll('#incidentsTable tr');
    const filter = document.getElementById('statusFilter');

    function updateCounts() {
        const counts = {open: 0, review: 0, resolved: 0};
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            if (counts[status] !== undefined) counts[status]++;
        });
        document.getElementById('count-open').textContent = counts.open;
        document.getElementById('count-review').textContent = counts.review;
        document.getElementById('count-resolved').textContent = counts.resolved;
    }

    filter.addEventListener('change', () => {
        const value = filter.value;
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = (!value || status === value) ? '' : 'none';
        });
    });

    // Confirmación antes de marcar como resuelta
    document.querySelectorAll('.change-status-form').forEach(form => {
        form.addEventListener('submit', (e) => {
            const select = form.querySelector('select[name="status"]');
            if (select.value === 'resolved') {
                if (!confirm('¿Seguro que quieres marcar esta incidencia como resuelta?')) {
                    e.preventDefault();
                }
            }
        });
    });

    updateCounts();
</script>
</body>
</html>
