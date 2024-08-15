@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mt-3 mx-3" data-toggle="modal" data-target="#exampleModal">
                Agregar Slider
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method='post' action="{{ route('admin.slider.store') }}" enctype='multipart/form-data'>
                                {{csrf_field()}}
                                <div class='form-group '>
                                    <label>Titulo:</label>
                                    <input class="form-control" name="titulo" id="titulo">
                                    <label>Descripcion:</label>
                                    <textarea class="form-control" row="10" col="30" name="descripcion" id="descripcion"></textarea>
                                    <div class="form-group mt-3">
                                        <label for='image'>Imagen: </label>
                                        <input type="file" name="image" />
                                        <div class='text-danger'>{{$errors->first('image')}}</div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type='submit' class='btn btn-primary'>Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                    <tr>
                        <td><img src="{{URL::asset($slider->ruta_img)}}" width="50px"></td>
                        <td>{{$slider->titulo}}</td>
                        <td>{{$slider->descripcion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop