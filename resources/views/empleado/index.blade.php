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
        <button type="button" id="btnAddEmployee" class="btn btn-primary mb-3">
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
                                    <!-- Botón para editar empleado -->
                                    <button type="button" class="btn btn-warning btn-sm btnEditEmployee" data-id="{{ $empleado->id }}">
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
@endsection

@section('js')
    <!-- Incluye el archivo CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

      <!-- Incluye los archivos JavaScript de Bootstrap, Popper.js y SweetAlert2 -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // SweetAlert2 para Añadir Empleado
        document.querySelector('#btnAddEmployee').addEventListener('click', function() {
            Swal.fire({
                title: 'Añadir empleado',
                html: `<form id="addEmployeeForm">
                          <div class="mb-3">
                              <label for="Nombre" class="form-label">Nombre</label>
                              <input id="Nombre" type="text" class="swal2-input" name="Nombre">
                          </div>
                          <div class="mb-3">
                              <label for="ApellidoPaterno" class="form-label">Apellido Paterno</label>
                              <input id="ApellidoPaterno" type="text" class="swal2-input" name="ApellidoPaterno">
                          </div>
                          <div class="mb-3">
                              <label for="ApellidoMaterno" class="form-label">Apellido Materno</label>
                              <input id="ApellidoMaterno" type="text" class="swal2-input" name="ApellidoMaterno">
                          </div>
                          <div class="mb-3">
                              <label for="Cargo" class="form-label">Cargo</label>
                              <input id="Cargo" type="text" class="swal2-input" name="Cargo">
                          </div>
                          <div class="mb-3">
                              <label for="Correo" class="form-label">Correo</label>
                              <input id="Correo" type="email" class="swal2-input" name="Correo">
                          </div>
                          <div class="mb-3">
                              <label for="image" class="form-label">Imagen</label>
                              <input id="foto" type="file" class="swal2-input" name="foto">
                          </div>
                       </form>`,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                preConfirm: () => {
                    const Nombre = Swal.getPopup().querySelector('#Nombre').value;
                    const ApellidoPaterno = Swal.getPopup().querySelector('#ApellidoPaterno').value;
                    const ApellidoMaterno = Swal.getPopup().querySelector('#ApellidoMaterno').value;
                    const Cargo = Swal.getPopup().querySelector('#Cargo').value;
                    const Correo = Swal.getPopup().querySelector('#Correo').value;
                    
                    if (!Nombre || !ApellidoPaterno || !ApellidoMaterno || !Cargo || !Correo) {
                        Swal.showValidationMessage(`Por favor, rellena todos los campos`);
                    }
                    
                    return {
                        Nombre: Nombre,
                        ApellidoPaterno: ApellidoPaterno,
                        ApellidoMaterno: ApellidoMaterno,
                        Cargo: Cargo,
                        Correo: Correo
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('Nombre', result.value.Nombre);
                    formData.append('ApellidoPaterno', result.value.ApellidoPaterno);
                    formData.append('ApellidoMaterno', result.value.ApellidoMaterno);
                    formData.append('Cargo', result.value.Cargo);
                    formData.append('Correo', result.value.Correo);

                    // Si se seleccionó una imagen
                    const fotoInput = Swal.getPopup().querySelector('#foto');
                    if (fotoInput.files.length > 0) {
                        formData.append('foto', fotoInput.files[0]);
                    }

                    $.ajax({
                        url: "{{ route('empleados.store') }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire('Empleado añadido', '', 'success');
                            location.reload(); // Recargar la página para ver el nuevo empleado
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo añadir el empleado.', 'error');
                        }
                    });
                }
            });
        });

        // SweetAlert2 para Editar Empleado
        document.querySelectorAll('[id^=btnEditEmployee]').forEach(button => {
            button.addEventListener('click', function() {
                const empleadoId = this.getAttribute('data-bs-target').split('-')[1];
                $.get(`{{ url('empleados') }}/${empleadoId}/edit`, function(data) {
                    Swal.fire({
                        title: 'Editar empleado',
                        html: `<form id="editEmployeeForm">
                                  <input type="hidden" id="editEmployeeId" value="${data.id}">
                                  <div class="mb-3">
                                      <label for="editNombre" class="form-label">Nombre</label>
                                      <input id="editNombre" type="text" class="swal2-input" value="${data.Nombre}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="editApellidoPaterno" class="form-label">Apellido Paterno</label>
                                      <input id="editApellidoPaterno" type="text" class="swal2-input" value="${data.ApellidoPaterno}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="editApellidoMaterno" class="form-label">Apellido Materno</label>
                                      <input id="editApellidoMaterno" type="text" class="swal2-input" value="${data.ApellidoMaterno}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="editCargo" class="form-label">Cargo</label>
                                      <input id="editCargo" type="text" class="swal2-input" value="${data.Cargo}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="editCorreo" class="form-label">Correo</label>
                                      <input id="editCorreo" type="email" class="swal2-input" value="${data.Correo}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="editFoto" class="form-label">Imagen</label>
                                      <input id="editFoto" type="file" class="swal2-input">
                                  </div>
                               </form>`,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        preConfirm: () => {
                            const id = Swal.getPopup().querySelector('#editEmployeeId').value;
                            const Nombre = Swal.getPopup().querySelector('#editNombre').value;
                            const ApellidoPaterno = Swal.getPopup().querySelector('#editApellidoPaterno').value;
                            const ApellidoMaterno = Swal.getPopup().querySelector('#editApellidoMaterno').value;
                            const Cargo = Swal.getPopup().querySelector('#editCargo').value;
                            const Correo = Swal.getPopup().querySelector('#editCorreo').value;

                            if (!Nombre || !ApellidoPaterno || !ApellidoMaterno || !Cargo || !Correo) {
                                Swal.showValidationMessage(`Por favor, rellena todos los campos`);
                            }

                            return {
                                id: id,
                                Nombre: Nombre,
                                ApellidoPaterno: ApellidoPaterno,
                                ApellidoMaterno: ApellidoMaterno,
                                Cargo: Cargo,
                                Correo: Correo
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const formData = new FormData();
                            formData.append('_token', "{{ csrf_token() }}");
                            formData.append('_method', 'PUT');
                            formData.append('Nombre', result.value.Nombre);
                            formData.append('ApellidoPaterno', result.value.ApellidoPaterno);
                            formData.append('ApellidoMaterno', result.value.ApellidoMaterno);
                            formData.append('Cargo', result.value.Cargo);
                            formData.append('Correo', result.value.Correo);

                            // Si se seleccionó una imagen
                            const fotoInput = Swal.getPopup().querySelector('#editFoto');
                            if (fotoInput.files.length > 0) {
                                formData.append('foto', fotoInput.files[0]);
                            }

                            $.ajax({
                                url: `{{ url('empleados') }}/${result.value.id}`,
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    Swal.fire('Empleado actualizado', '', 'success');
                                    location.reload(); // Recargar la página para ver los cambios
                                },
                                error: function(xhr) {
                                    Swal.fire('Error', 'No se pudo actualizar el empleado.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        });


        //datatables
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
          // Modal de edición para cada empleado
          @foreach($empleados as $empleado)
                $('#editModal-{{ $empleado->id }}').on('shown.bs.modal', function () {
                    $('#Nombre').trigger('focus');
                });
          @endforeach    
    </script>
@endsection
