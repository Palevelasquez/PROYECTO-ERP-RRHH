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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @auth
    <div class="d-flex">
        <!-- Sidebar for authenticated users -->
        <nav class="sidebar">
            <!-- Toggle button -->
            <button class="sidebar-toggle" id="sidebarToggle">
                <span class="toggle-icon">&#9776;</span>
            </button>
            <!-- Sidebar content -->
            <div class="sidebar-content">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'SISBIANCA') }}
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="employeesToggle">
                            <span class="icon">👥</span> Empleados
                        </a>
                        <ul class="sub-nav" id="employeesSubmenu">
                            <li><a class="sub-nav-link" href="{{ route('empleado.index') }}">Lista de Empleados</a></li>
                            <li><a class="sub-nav-link" href="#">Historial de Empleados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="documentsToggle">
                            <span class="icon">📄</span> Documentos
                        </a>
                        <ul class="sub-nav" id="documentsSubmenu">
                            <li><a class="sub-nav-link" href="{{ route('documents.index') }}">Agregar Documento</a></li>
                            <li><a class="sub-nav-link" href="{{ route('documents.download') }}">Descargar Documentos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="reportsToggle">
                            <span class="icon">📊</span> Reportes
                        </a>
                        <ul class="sub-nav" id="reportsSubmenu">
                            <li><a class="sub-nav-link" href="#">Reporte Financiero</a></li>
                            <li><a class="sub-nav-link" href="#">Reporte de Rendimiento</a></li>
                            <li><a class="sub-nav-link" href="#">Reporte de Asistencia</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav mt-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
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
                </ul>
            </div>
        </nav>

        <!-- Main content area -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @else
    <div class="main-container" style="display: flex; height: 100vh;">
        <!-- Left section -->
        <div class="left-side" style="flex: 1; background-color: #154360; color: white; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h1>Bienvenido a SISBIANCA</h1>
            <p>¡Tu solución integral para la gestión de empleados!</p>
            <img src="{{ asset('images/pngegg.png') }}" alt="Imagen bonita" style="max-width: 50%; height: auto;">
        </div>

        <!-- Right section -->
        <div class="right-side" style="flex: 1; background-color: #f5f5f5; padding: 20px; display: flex; justify-content: center; align-items: center;">
            <div class="login-container">
                <div class="login-box">
                    <h2>Iniciar sesión</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" required>
                            <label>Correo electrónico</label>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" required>
                            <label>Contraseña</label>
                        </div>
                        <button type="submit" class="btn-login">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <script>
        // Toggle sidebar visibility
        const toggleButton = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        // Toggle subsections
        document.querySelectorAll('.nav-item > .nav-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const submenuId = this.id.replace('Toggle', 'Submenu');
                const submenu = document.getElementById(submenuId);
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                this.parentElement.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
