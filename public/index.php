<?php

require_once "../vendor/autoload.php";

$path = explode('/', trim( $_SERVER['REQUEST_URI']));
$views = '/views/';


 //SessionController::userSignUp("rusben", "rusben@elpuig.xeill.net", "password");
// die();

//SessionController::userLogin("ivan", "password");
//SessionController::userSignUp("ivan","ibermejo@elpuig.xeill.net","password");
//print_r($_SESSION);
//die();


switch ($path[1]) {
    case '':
    case '/':
        require __DIR__ . $views . 'login.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            // Intentamos iniciar sesión con los datos ingresados
            $result = SessionController::userLogin($username, $password);
            print_r($_SESSION);
        }
        break;

    case 'signup':
        require __DIR__ . $views . 'signup.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Intentamos iniciar sesión con los datos ingresados
            $result = SessionController::userSignUp($username, $email, $password);
        }
        break;
    
    case 'admin':      
        require __DIR__ . $views . 'admin.php';
        break;

    case 'not-found':
    default:
        http_response_code(404);
        require __DIR__ . $views . '404.php';
}
