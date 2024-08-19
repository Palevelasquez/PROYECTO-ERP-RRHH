@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <!-- Barra de Navegación Horizontal para Submódulos -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}">/</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}">ÁREAS</a>
                </li>
            </ul>
        </div>
    </nav>
    <h1>Empleados</h1>
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Empleados</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            Añadir empleado
        </button>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Empleados
            </div>
            
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{ $empleado->id }}">
                                            <img src="{{ asset('storage/fotos/' . $empleado->Foto) }}" alt="Foto" class="img-thumbnail rounded-circle" width="40">
                                        </a>
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
                
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?')">
                                            <i class="fa-solid fa-trash-can"></i> 
                                        </button>
                                    </form>
                
                                    <a href="{{ route('empleados.export', ['empleado' => $empleado->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-file-export"></i>
                                    </a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para añadir empleado -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Agregar un nuevo empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir empleado -->
                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf
                        <!-- Campos del formulario -->
                        <!-- Añade aquí los campos que necesites -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Incluye el archivo CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Incluye los archivos JavaScript de Bootstrap y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "pageLength": 20, // Ajusta el número de registros por página según tu necesidad
                "processing": true,
            });
        });
    </script>
@endsection
