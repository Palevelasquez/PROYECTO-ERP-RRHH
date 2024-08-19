@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <!-- Componente de Livewire para estadísticas del dashboard -->
            <div class="col-lg-12">
                @livewire('dashboard-statistics')
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <!-- Example Card 1 -->
        <div class="col-lg-4 col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Card Title 1</h3>
                </div>
                <div class="card-body">
                    This is an example of a card with primary color.
                </div>
            </div>
        </div>

        <!-- Example Card 2 -->
        <div class="col-lg-4 col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Card Title 2</h3>
                </div>
                <div class="card-body">
                    This is an example of a card with success color.
                </div>
            </div>
        </div>

        <!-- Example Card 3 -->
        <div class="col-lg-4 col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Card Title 3</h3>
                </div>
                <div class="card-body">
                    This is an example of a card with warning color.
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Contenido del componente de estadísticas -->
        <h3>Dashboard Statistics</h3>
        <!-- Agrega aquí el contenido y estilo de tu componente -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
<script>
    Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
    )
  </script>
@stop
