<!-- resources/views/departments/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@endsection

@section('content')
    <!-- Aquí va el contenido para la vista de Departamentos -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <!-- Acciones (ver, editar, eliminar) -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
