<?php

require_once "../vendor/autoload.php";
require_once "../src/controller/SessionController.php"; // Asegúrate de incluir esto

session_start(); // Inicia la sesión
$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Desactiva la caché en desarrollo
]);

$path = explode('/', trim($_SERVER['REQUEST_URI']));
$views = __DIR__ . '/views/'; // Ruta absoluta a la carpeta de vistas

switch ($path[1]) {
    case '':
    case '/':
        // Mostrar el formulario de login
        require $views . 'login.php';

        // Procesar el formulario de login
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Intentar iniciar sesión
            $result = SessionController::userLogin($username, $password);

            if ($result === "success") {
                // Redirigir al home si el login es exitoso
                header("Location: /home");
                exit();
            } else {
                // Mostrar un mensaje de error si el login falla
                echo "<script>alert('$result');</script>";
            }
        }
        break;

    case 'signup':
        // Mostrar el formulario de registro
        require $views . 'signup.php';

        // Procesar el formulario de registro
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar registrar al usuario
            $result = SessionController::userSignUp($username, $email, $password);

            if ($result === "Usuario registrado exitosamente") {
                // Redirigir al login después del registro
                header("Location: /");
                exit();
            } else {
                // Mostrar un mensaje de error si el registro falla
                echo "<script>alert('$result');</script>";
            }
        }
        break;

    case 'home':
        // Verificar si el usuario está logueado
        if (isset($_SESSION['user_id'])) {
            require $views . 'home.php';
        } else {
            // Redirigir al login si no hay sesión activa
            header("Location: /");
            exit();
        }
        break;

    case 'scuderias':
        if (isset($_SESSION['user_id'])) {
            $teams = DatabaseController::getTeams();
            echo $twig->render('scuderias.html', ['teams' => $teams]);
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
            $teams = DatabaseController::getCircuits();
            echo $twig->render('circuitos.html', ['circuits' => $circuit]);
        } else {
            header("Location: /");
            exit();
        }
        break;

    case 'not-found':
    default:
        // Mostrar la página 404
        http_response_code(404);
        require $views . '404.php';
        break;
}