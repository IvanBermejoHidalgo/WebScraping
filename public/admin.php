<?php
session_start(); // Inicia la sesión al principio

require_once "../vendor/autoload.php";
require_once "../src/controller/AdminController.php";
require_once "../src/controller/TeamsController.php";
require_once "../src/controller/DatabaseController.php";

$loader = new \Twig\Loader\FilesystemLoader('views/admin');
$twig = new \Twig\Environment($loader, ['cache' => false]);

$path = explode('/', trim($_SERVER['REQUEST_URI']));
$views = __DIR__ . '/views/admin/';

// Verificar si el administrador está logueado
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

// Manejo de rutas
switch ($path[1]) {
    case 'admin':
        if ($path[2] === 'dashboard') {
            if (isAdminLoggedIn()) {
                // Obtener datos para el dashboard
                $teams = DatabaseController::getTeams();
                $drivers = DatabaseController::getDrivers();
                $races = DatabaseController::getRaces();

                // Renderizar el dashboard con los datos
                echo $twig->render('dashboard.php', [
                    'teams' => $teams,
                    'drivers' => $drivers,
                    'races' => $races,
                ]);
            } else {
                // Redirigir al login si no está autenticado
                header("Location: /admin");
                exit();
            }
        } elseif ($path[2] === 'scuderias') {
            if (isAdminLoggedIn()) {
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($path[3])) {
                    // Procesar añadir o editar equipo
                    $team_name = $_POST['team_name'];
                    $driver1 = $_POST['driver1'];
                    $driver2 = $_POST['driver2'];
                    $img_team = $_POST['img_team'];
                    $img_car = $_POST['img_car'];

                    if ($path[3] === 'add') {
                        TeamsController::addTeam($team_name, $driver1, $driver2, $img_team, $img_car);
                        header("Location: /admin/scuderias");
                        exit();
                    } elseif ($path[3] === 'edit' && isset($path[4])) {
                        $id = $path[4];
                        TeamsController::editTeam($id, $team_name, $driver1, $driver2, $img_team, $img_car);
                        header("Location: /admin/scuderias");
                        exit();
                    }
                } elseif ($path[3] === 'delete' && isset($path[4])) {
                    // Eliminar equipo
                    $id = $path[4];
                    TeamsController::deleteTeam($id);
                    header("Location: /admin/scuderias");
                    exit();
                } else {
                    // Mostrar lista de equipos
                    $teams = DatabaseController::getTeams();
                    echo $twig->render('scuderias/teams.php', ['teams' => $teams]);
                }
            } else {
                header("Location: /admin");
                exit();
            }
        } elseif ($path[2] === 'add-team') {
            if (isAdminLoggedIn()) {
                echo $twig->render('scuderias/add_team.php');
            } else {
                header("Location: /admin");
                exit();
            }
        } elseif ($path[2] === 'edit-team' && isset($path[3])) {
            if (isAdminLoggedIn()) {
                $id = $path[3];
                $team = TeamsController::getTeamById($id);
                echo $twig->render('scuderias/edit_team.php', ['team' => $team]);
            } else {
                header("Location: /admin");
                exit();
            }
        } else {
            // Mostrar el formulario de login para administradores
            require $views . 'login.php';

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result = AdminController::adminLogin($username, $password);

                if ($result === "success") {
                    header("Location: /admin/dashboard");
                    exit();
                } else {
                    echo "<script>alert('$result');</script>";
                }
            }
        }
        break;

    default:
        http_response_code(404);
        require $views . '../404.php';
        break;
}