<?php

require_once "../vendor/autoload.php";
require_once "../src/controller/SessionController.php";
require_once "../src/controller/DatabaseController.php"; // Asegúrate de incluir DatabaseController

session_start();
$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$path = explode('/', trim($_SERVER['REQUEST_URI']));
$views = __DIR__ . '/views/';

// Si la ruta comienza con /admin, redirige a admin.php
if ($path[1] === 'admin') {
    require __DIR__ . '/admin.php';
    exit();
}

// Manejo de rutas principales
switch ($path[1]) {
    case '':
    case '/':
        require $views . 'login.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = SessionController::userLogin($username, $password);
            if ($result === "success") {
                header("Location: /home");
                exit();
            } else {
                echo "<script>alert('$result');</script>";
            }
        }
        break;

    case 'signup':
        require $views . 'signup.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = SessionController::userSignUp($username, $email, $password);
            if ($result === "Usuario registrado exitosamente") {
                header("Location: /");
                exit();
            } else {
                echo "<script>alert('$result');</script>";
            }
        }
        break;

    case 'home':
        if (isset($_SESSION['user_id'])) {
            // Obtener los datos de los ganadores
            $winners = DatabaseController::getWinners();

            // Convertir los datos a un formato que Twig pueda usar
            $labels = [];
            $data = [];
            foreach ($winners as $winner) {
                $labels[] = $winner['winner'];
                $data[] = $winner['count'];
            }

            // Renderizar la plantilla Twig con los datos
            echo $twig->render('home.php', [
                'labels' => $labels,
                'data' => $data,
                'labels_js' => json_encode($labels), // Convertir a JSON para JavaScript
                'data_js' => json_encode($data),     // Convertir a JSON para JavaScript
            ]);
        } else {
            header("Location: /");
            exit();
        }
        break;

    case 'scuderias':
        if (isset($_SESSION['user_id'])) {
            $teams = DatabaseController::getTeams();
            $teamsWithDrivers = DatabaseController::getTeamsWithDrivers();
            echo $twig->render('scuderias.html', [
                'teams' => $teams,
                'teamsWithDrivers' => $teamsWithDrivers
            ]);
        } else {
            header("Location: /");
            exit();
        }
        break;

    case 'pilotos':
        if (isset($_SESSION['user_id'])) {
            $driver = DatabaseController::getDrivers();
            echo $twig->render('pilotos.html', ['drivers' => $driver]);
        } else {
            header("Location: /");
            exit();
        }
        break;

    case 'circuitos':
        if (isset($_SESSION['user_id'])) {
            $race = DatabaseController::getRaces();
            echo $twig->render('circuitos.html', ['races' => $race]);
        } else {
            header("Location: /");
            exit();
        }
        break;

    case 'logout':
        // Cerrar sesión
        session_start(); // Iniciar la sesión si no está iniciada
        session_destroy(); // Destruir la sesión
        header("Location: /"); // Redirigir al login
        exit();
        break;

    case 'not-found':
    default:
        http_response_code(404);
        require $views . '404.php';
        break;
}