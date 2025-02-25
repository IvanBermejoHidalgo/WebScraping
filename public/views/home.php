<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Fórmula 1</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #e10600; /* Rojo de Fórmula 1 */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffc107 !important; /* Amarillo al hacer hover */
        }
        .jumbotron {
            background: url('https://via.placeholder.com/1500x500') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 25px;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }
        .jumbotron p {
            font-size: 1.5rem;
        }
        .section {
            padding: 60px 0;
        }
        .section h2 {
            margin-bottom: 30px;
            font-weight: bold;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/home">Fórmula 1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/scuderias">Scuderias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pilotos">Pilotos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/circuitos">Circuitos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron (Cabecera) -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="text-black">Bienvenido a Fórmula 1</h1>
            <p class="text-black">Explora el emocionante mundo de la Fórmula 1: equipos, pilotos y circuitos.</p>
        </div>
    </div>

    <!-- Sección de contenido -->
    <div class="container section">
        <div class="row">
            <div class="col-md-8">
                <h2>¿Qué es la Fórmula 1?</h2>
                <p>
                    La Fórmula 1 es la categoría más alta del automovilismo deportivo. Es un campeonato mundial de carreras de monoplazas en el que compiten los mejores pilotos y equipos del mundo.
                </p>
                <p>
                    Cada temporada consta de una serie de carreras, conocidas como Grandes Premios, que se celebran en circuitos de todo el mundo. Los equipos compiten por el Campeonato de Constructores, mientras que los pilotos luchan por el Campeonato de Pilotos.
                </p>
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" class="img-fluid rounded" alt="Fórmula 1">
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Fórmula 1. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>