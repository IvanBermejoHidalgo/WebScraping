<?php
ob_start();
require_once "../vendor/autoload.php";

$path = explode('/', trim($_SERVER['REQUEST_URI']));
$views = '/views/';

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Redirigir al login si no está autenticado
function requireAuth() {
    if (!isAuthenticated()) {
        header('Location: /');
        exit();
    }
}

switch ($path[1]) {
    case '':
    case '/':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = SessionController::userLogin($username, $password);
            if ($result) {
                header('Location: /home');
                exit();
            } else {
                $error = "Credenciales inválidas";
            }
        }
        require __DIR__ . $views . 'login.php';
        break;

    case 'api':
        if ($path[2] === "session" && $path[3] === "token") {
            ApiController::generateSessionToken();
        }
        break;

    case 'signup':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = SessionController::userSignUp($username, $email, $password);
            if ($result) {
                header('Location: /');
                exit();
            } else {
                $error = "Error en el registro";
            }
        }
        require __DIR__ . $views . 'signup.php';
        break;

    case 'admin':
        requireAuth(); // Asegurar que el usuario esté autenticado
        require __DIR__ . $views . 'admin.php';
        break;

    case 'home':
        requireAuth(); // Asegurar que el usuario esté autenticado
        require __DIR__ . $views . 'home.php';
        break;

    case 'not-found':
    default:
        http_response_code(404);
        require __DIR__ . $views . '404.php';
}