@extends('adminlte::page')

@section('title', 'Empleados')



@section('styles')
    <style>
        .navbar-custom {
            background-color: #f8f9fa; /* Color de fondo personalizado */
            border-bottom: 1px solid #e3e3e3; /* Borde inferior para separación */
        }

        .navbar-custom .navbar-nav {
            margin-left: auto;
            margin-right: auto;
        }

        .navbar-custom .nav-item {
            margin-right: 20px; /* Espacio entre los elementos de navegación */
        }
    </style>
@endsection



@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Empleados</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            Agregar un nuevo empleado
        </button>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Empleados
            </div>
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Cargo</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>
                                    @if($empleado->Foto)
                                        <a href="#" data-toggle="modal" data-target="#modal{{ $empleado->id }}">
                                            <img src="{{ asset('storage/fotos/' . $empleado->Foto) }}" alt="Foto" class="img-thumbnail rounded-circle" width="40">
                                        </a>
<!-- Modal AGREGAR NUEVO EMPLEADO-->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Agregar un nuevo empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" method="POST" action="{{ route('empleados.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="ApellidoPaterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="ApellidoPaterno" name="ApellidoPaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="ApellidoMaterno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="ApellidoMaterno" name="ApellidoMaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="Correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="Correo" name="Correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" required>
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="Foto" name="Foto">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $empleado->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Foto de {{ $empleado->Nombre }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/fotos/' . $empleado->Foto) }}" alt="Foto" class="img-fluid">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span>No disponible</span>
                                    @endif
                                </td>
                                <td>{{ $empleado->Nombre }}</td>
                                <td>{{ $empleado->ApellidoPaterno }}</td>
                                <td>{{ $empleado->ApellidoMaterno }}</td>
                                <td>{{ $empleado->cargo }}</td>
                                <td>{{ $empleado->Correo }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $empleado->id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <!-- Formulario de eliminación -->
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">Eliminar</button>
                                    </form>

                                        <!-- Enlace para exportar -->
                                    <a href="{{ route('empleados.export', ['empleado' => $empleado->id]) }}" class="btn btn-info btn-sm">Exportar</a> 
                                </td>
                            </tr>
                        @endforeach
                        <!-- Modal de edición -->

                        <!-- Modal de edición -->
@foreach($empleados as $empleado)
<div class="modal fade" id="editModal-{{ $empleado->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $empleado->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{ $empleado->id }}">Editar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="{{ old('Nombre', $empleado->Nombre) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="ApellidoPaterno" value="{{ old('ApellidoPaterno', $empleado->ApellidoPaterno) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellido_materno" name="ApellidoMaterno" value="{{ old('ApellidoMaterno', $empleado->ApellidoMaterno) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="Cargo" value="{{ old('Cargo', $empleado->Cargo) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="Correo" value="{{ old('Correo', $empleado->Correo) }}" required>
                    </div>
                    <!-- Agrega otros campos necesarios aquí -->
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ $empleados->links() }}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
