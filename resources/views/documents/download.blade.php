<!-- resources/views/documents/download.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Descargar Documentos</h2>
    <!-- El formulario usa POST para enviar los datos -->
    <form action="{{ route('documents.download.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="empleado_id_download">Empleado:</label>
            <select name="empleado_id_download" id="empleado_id_download" class="form-control">
                <option value="">Seleccione un empleado</option>
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
