<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Equipo</title>
    <!-- Bootstrap CSS -->
    <link href="../../assets/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
            padding-top: 56px; /* Ajuste para el navbar fijo */
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar (opcional, si tienes uno) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/admin/dashboard">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/scuderias/teams">Gestionar Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/drivers">Gestionar Pilotos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/races">Gestionar Carreras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/logout">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="form-container">
        <h1>Añadir Equipo</h1>
        <form method="POST" action="/admin/scuderias/add">
            <div class="mb-3">
                <label for="team_name" class="form-label">Nombre del equipo:</label>
                <input type="text" class="form-control" id="team_name" name="team_name" required>
            </div>
            <div class="mb-3">
                <label for="driver1" class="form-label">Piloto 1:</label>
                <input type="text" class="form-control" id="driver1" name="driver1" required>
            </div>
            <div class="mb-3">
                <label for="driver2" class="form-label">Piloto 2:</label>
                <input type="text" class="form-control" id="driver2" name="driver2" required>
            </div>
            <div class="mb-3">
                <label for="img_team" class="form-label">URL del logo del equipo:</label>
                <input type="text" class="form-control" id="img_team" name="img_team" required>
            </div>
            <div class="mb-3">
                <label for="img_car" class="form-label">URL del coche:</label>
                <input type="text" class="form-control" id="img_car" name="img_car" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir Equipo</button>
        </form>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>