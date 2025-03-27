<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #343a40;
            transition: all 0.3s;
        }
        #sidebar.hidden {
            margin-left: -250px;
        }
        #sidebar .nav-link {
            color: #fff;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background-color: #495057;
        }
        #content {
            transition: margin-left 0.3s;
        }
        #content.full {
            margin-left: 0 !important;
        }
        #toggle-btn {
            margin-left: 1rem;
        }
        @media (min-width: 992px) {
            #content {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between align-items-center px-3">
        <div>
            <button class="btn btn-outline-light" id="toggle-btn">☰</button>
        </div>
        <a class="navbar-brand mx-auto text-center" href="/">Fábrica de Automóveis</a>
        <div style="width: 36px;"></div>
    </nav>
    <div class="d-flex">
        <div id="sidebar" class="d-flex flex-column p-3 text-white">
            <h4 class="text-white">Menu</h4>
            <nav class="nav nav-pills flex-column">
                <a href="{{ route('marcas.index') }}" class="nav-link">Marcas</a>
                <a href="{{ route('modelos.index') }}" class="nav-link">Modelos</a>
                <a href="{{ route('carros.index') }}" class="nav-link">Carros</a>
            </nav>
        </div>

        <!-- Conteúdo -->
        <div class="container-fluid p-4" id="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full');
        });
    </script>
    @yield('scripts')
</body>
</html>
