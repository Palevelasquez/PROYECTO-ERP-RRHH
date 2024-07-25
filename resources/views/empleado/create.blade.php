@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Agregar Nuevo Empleado</h1>
        <div class="card">
            <div class="card-header">
                Nuevo Empleado
            </div>
            <div class="card-body">
                <form action="{{ route('empleado.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ApellidoPaterno">Apellido Paterno</label>
                        <input type="text" name="ApellidoPaterno" id="ApellidoPaterno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ApellidoMaterno">Apellido Materno</label>
                        <input type="text" name="ApellidoMaterno" id="ApellidoMaterno" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Correo">Correo</label>
                        <input type="email" name="Correo" id="Correo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input type="file" name="Foto" id="Foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
