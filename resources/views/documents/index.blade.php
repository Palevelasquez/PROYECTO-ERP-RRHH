<!-- resources/views/documents/index.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Importar Documentos</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="empleado_id" class="form-label">Empleado:</label>
                    <select name="empleado_id" id="empleado_id" class="form-select">
                        @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipo de Documento:</label>
                    <select name="type" id="type" class="form-select">
                        <option value="contract">Contrato</option>
                        <option value="signature">Firma</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Seleccionar archivo (PDF o Imagen):</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Importar Documento</button>
            </form>
        </div>
    </div>
</div>
@endsection
