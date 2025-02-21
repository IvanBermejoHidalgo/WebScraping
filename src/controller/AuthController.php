<?php
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

class AuthController {
    private $key = "tu_clave_secreta";

    public function login($username, $password) {
        $sessionController = new SessionController();
        if ($sessionController->userLogin($username, $password)) {
            $payload = array(
                "user_id" => $_SESSION['user_id'],
                "username" => $username,
                "exp" => time() + 3600 // Token expira en 1 hora
            );
            $jwt = JWT::encode($payload, $this->key);
            return json_encode(array("token" => $jwt));
        } else {
            return json_encode(array("error" => "Credenciales inválidas"));
        }
    }

    public function validateToken($token) {
        try {
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            return $decoded;
        } catch (Exception $e) {
            return null;
        }
    }
}