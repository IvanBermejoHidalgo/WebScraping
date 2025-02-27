<?php
// Obtener los pilotos desde la base de datos
$drivers = DatabaseController::getDrivers();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilotos - Fórmula 1</title>
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
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
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

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1 class="mb-4">Pilotos</h1>
        <div class="row">
            <?php foreach ($drivers as $driver): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= $driver['flag_url'] ?>" class="card-img-top" alt="<?= $driver['first_name'] ?> <?= $driver['last_name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $driver['first_name'] ?> <?= $driver['last_name'] ?></h5>
                            <p class="card-text">
                                <strong>Equipo:</strong> <?= $driver['team'] ?><br>
                                <strong>Puntos:</strong> <?= $driver['points'] ?><br>
                                <strong>País:</strong> <?= $driver['country'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>