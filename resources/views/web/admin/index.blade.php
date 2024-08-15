@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="display-4">Bienvenido al Dashboard</h1>
    <p class="lead">Aquí encontrarás las últimas noticias y actualizaciones importantes.</p>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Carousel 1 -->
            <div class="col-md-4">
                <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/carousel-images/image1.jpg" class="d-block w-100" alt="Imagen 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image2.jpg" class="d-block w-100" alt="Imagen 2">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image3.jpg" class="d-block w-100" alt="Imagen 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- Carousel 2 -->
            <div class="col-md-4">
                <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/carousel-images/image1.jpg" class="d-block w-100" alt="Imagen 4">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image2.jpg" class="d-block w-100" alt="Imagen 5">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image3.jpg" class="d-block w-100" alt="Imagen 6">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- Carousel 3 -->
            <div class="col-md-4">
                <div id="carouselExampleControls3" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/carousel-images/image1.jpg" class="d-block w-100" alt="Imagen 4">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image2.jpg" class="d-block w-100" alt="Imagen 5">
                        </div>
                        <div class="carousel-item">
                            <img src="/carousel-images/image3.jpg" class="d-block w-100" alt="Imagen 6">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop
