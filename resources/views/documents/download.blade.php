<!-- resources/views/documents/download.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Descargar Documentos</h2>
    <form action="{{ route('documents.download') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="empleado_id">Empleado:</label>
            <select name="empleado_id" id="empleado_id" class="form-control">
                <option value="">Seleccione un empleado</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="document_ids">Documentos:</label>
            <select name="document_ids[]" id="document_ids" class="form-control" multiple>
                <!-- Opciones se llenarán dinámicamente -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Descargar Documentos</button>
    </form>
</div>

<script>
document.getElementById('empleado_id').addEventListener('change', function() {
    var empleadoId = this.value;
    var documentSelect = document.getElementById('document_ids');
    documentSelect.innerHTML = '';

    if (empleadoId) {
        fetch(`/documents/${empleadoId}/list`)
            .then(response => response.json())
            .then(data => {
                data.forEach(doc => {
                    var option = document.createElement('option');
                    option.value = doc.id;
                    option.text = doc.type + ' - ' + doc.file_path.split('/').pop();
                    documentSelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching documents:', error));
    }
});
</script>
@endsection
