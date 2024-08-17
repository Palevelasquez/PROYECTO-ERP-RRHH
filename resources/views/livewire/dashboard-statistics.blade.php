<!-- resources/views/livewire/dashboard-statistics.blade.php -->

<div>
    <!-- Título del componente -->
    <h3>Estadísticas del Dashboard</h3>

    <!-- Contenedor para las estadísticas -->
    <div class="row">
        <!-- Total de Usuarios -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Usuarios Registrados</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('empleados.index') }}" class="btn btn-primary">Ver Todos los Usuarios</a>
                </div>
            </div>
        </div>

        <!-- Total de Empleados -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Total de Empleados</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $totalEmployees }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('empleados.index') }}" class="btn btn-primary">Ver Todos los Empleados</a>
                </div>
            </div>
        </div>

        <!-- Últimos Empleados -->
<div class="col-lg-4 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $latestEmployeesCount->count() }}</h3>
            <p>Últimos Empleados Agregados</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus"></i>
        </div>
    </div>
</div>

        <!-- Distribución de Empleados por Departamento -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Distribución de Empleados por Departamento</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($employeesByDepartment as $department)
                            <li>{{ $department->name }}: {{ $department->employees_count }} empleados</li>
                        @empty
                            <li>No hay empleados asignados a departamentos.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
</div>
