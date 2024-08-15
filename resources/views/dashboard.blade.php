@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="display-4">Bienvenido al Dashboard</h1>
    <p class="lead">Aquí encontrarás las últimas noticias y actualizaciones importantes.</p>
@stop

@section('content')
    <!-- Welcome Panel with Image Carousels -->
    <div class="container-fluid">
        <div class="row">
            <!-- Carousel 1 -->
            <div class="col-md-4">
                <div id="carousel1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/news1.jpg') }}" class="d-block w-100" alt="News 1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 1</h5>
                                <p>Descripción breve de la noticia 1.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news2.jpg') }}" class="d-block w-100" alt="News 2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 2</h5>
                                <p>Descripción breve de la noticia 2.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news3.jpg') }}" class="d-block w-100" alt="News 3">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 3</h5>
                                <p>Descripción breve de la noticia 3.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- Carousel 2 -->
            <div class="col-md-4">
                <div id="carousel2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/news4.jpg') }}" class="d-block w-100" alt="News 4">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 4</h5>
                                <p>Descripción breve de la noticia 4.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news5.jpg') }}" class="d-block w-100" alt="News 5">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 5</h5>
                                <p>Descripción breve de la noticia 5.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news6.jpg') }}" class="d-block w-100" alt="News 6">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 6</h5>
                                <p>Descripción breve de la noticia 6.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- Carousel 3 -->
            <div class="col-md-4">
                <div id="carousel3" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/news7.jpg') }}" class="d-block w-100" alt="News 7">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 7</h5>
                                <p>Descripción breve de la noticia 7.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news8.jpg') }}" class="d-block w-100" alt="News 8">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 8</h5>
                                <p>Descripción breve de la noticia 8.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/news9.jpg') }}" class="d-block w-100" alt="News 9">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Noticia 9</h5>
                                <p>Descripción breve de la noticia 9.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel3" role="button" data-slide="next">
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
@stop
