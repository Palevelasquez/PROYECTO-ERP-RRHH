@extends('layouts.app')
@section('content')
<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
    <br/>
    <br/>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
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
                <td>{{ $empleado->id }}</td>
                <td>
                    @if($empleado->Foto)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#previewModal" data-image="{{ asset('storage').'/'.$empleado->Foto }}">
                        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="Foto de {{ $empleado->Nombre }}">
                    </a>
                    @else
                    <p>No hay foto disponible</p>
                    @endif
                </td>
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->ApellidoPaterno }}</td>
                <td>{{ $empleado->ApellidoMaterno }}</td>
                <td>{{ $empleado->Correo }}</td>
                <td>
                    <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-warning">Editar</a>
                    <form action="{{ url('/empleado/' . $empleado->id) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $empleados->links() !!}

    <!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Previsualización de la Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" class="img-fluid" src="" alt="Foto del Empleado">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var previewModal = document.getElementById('previewModal');
    previewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var imageUrl = button.getAttribute('data-image');
        var modalImage = previewModal.querySelector('#previewImage');
        modalImage.src = imageUrl;
    });
});
</script>

@endsection
