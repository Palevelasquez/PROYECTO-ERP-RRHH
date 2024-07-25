@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Empleados</h1>
        <a href="{{ route('empleado.create') }}" class="btn btn-success mb-3">Agregar Nuevo Empleado</a>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Empleados
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Cargo</th>
                            <th>Correo</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->Nombre }}</td>
                                <td>{{ $empleado->ApellidoPaterno }}</td>
                                <td>{{ $empleado->ApellidoMaterno }}</td>
                                <td>{{ $empleado->cargo }}</td>
                                <td>{{ $empleado->Correo }}</td>
                                <td>
                                    @if($empleado->Foto)
                                        <img src="{{ asset('storage/fotos/' . $empleado->Foto) }}" alt="Foto" class="img-thumbnail" width="100">
                                    @else
                                        <span>No disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('empleado.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('empleado.destroy', $empleado->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">Eliminar</button>
                                    </form>
                                    <a href="{{ route('empleados.export', $empleado->id) }}" class="btn btn-success">Exportar a Sheets</a>                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection