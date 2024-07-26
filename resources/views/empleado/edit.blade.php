<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <!-- Agrega tus estilos aquí -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Editar Empleado</h1>

        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="ApellidoPaterno">Apellido Paterno</label>
                <input type="text" class="form-control" id="ApellidoPaterno" name="ApellidoPaterno" value="{{ $empleado->ApellidoPaterno }}" required>
            </div>
            <div class="form-group">
                <label for="ApellidoMaterno">Apellido Materno</label>
                <input type="text" class="form-control" id="ApellidoMaterno" name="ApellidoMaterno" value="{{ $empleado->apellidomaterno }}" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ $empleado->correo }}" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $empleado->cargo }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
</body>
</html>
