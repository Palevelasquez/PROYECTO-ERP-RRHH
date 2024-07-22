@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Empleados</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->ApellidoPaterno }}</td>
                <td>{{ $empleado->ApellidoMaterno }}</td>
                <td>{{ $empleado->Correo }}</td>
                <td>
                    <form action="{{ route('documents.export', $empleado->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Exportar a ZIP</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para exportar a Google Sheets -->
    <form action="{{ route('documents.exportToSheets') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Exportar a Google Sheets</button>
    </form>

    <hr>

    <h2>Importar Documentos</h2>
    <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="empleado_id">Empleado:</label>
            <select name="empleado_id" id="empleado_id" class="form-control">
                @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type">Tipo de Documento:</label>
            <select name="type" id="type" class="form-control">
                <option value="contract">Contrato</option>
                <option value="signature">Firma</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="file">Seleccionar archivo PDF:</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Importar Documento</button>
    </form>

    <hr>

    <h2>Descargar Documentos</h2>
    <form action="{{ route('documents.download') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="empleado_id_download">Empleado:</label>
            <select name="empleado_id_download" id="empleado_id_download" class="form-control">
                @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type_download">Tipo de Documento:</label>
            <select name="type_download" id="type_download" class="form-control">
                <option value="all">Todos los Documentos</option>
                <option value="contract">Contratos</option>
                <option value="signature">Firmas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Descargar Documentos</button>
    </form>
</div>
@endsection
