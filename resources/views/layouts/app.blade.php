<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISBIANCA') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Estilos personalizados para la barra de menú */
        .sidebar {
            width: 250px;
            transition: width 0.3s;
        }
        .sidebar.minimized {
            width: 80px;
        }
        .sidebar .nav-link {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
        }
        .sidebar.minimized .nav-link i {
            margin-right: 0;
        }
        .sidebar .nav-item {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="flex-column bg-white shadow-sm p-3 sidebar" id="sidebar">
            <!-- Botón para minimizar la barra de menú -->
            <button class="btn btn-primary mb-3" id="toggleSidebar">Minimizar</button>
            
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'SISBIANCA') }}
            </a>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('empleado.index') }}">
                        <i class="fas fa-users"></i>{{ __('Empleados') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('documents.index') }}">
                        <i class="fas fa-file-alt"></i>Documentos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chart.index') }}">
                        <i class="fas fa-chart-bar"></i>Gráficos
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column mt-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>{{ __('Login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i>{{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <div class="flex-grow-1 p-3">
            @yield('content')
        </div>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('minimized');
        });
    </script>
</body>
</html>