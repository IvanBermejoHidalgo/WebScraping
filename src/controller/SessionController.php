<?php

class SessionController {

    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public function userSignUp($username, $email, $password) {
        if ($this->exist($username, $email)) {
            return false; // Usuario o email ya existen
        }

        try {
            $sql = "INSERT INTO User (username, email, password) VALUES (:username, :email, :password)";
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $hashed_password);
            $statement->execute();

            return true; // Usuario registrado exitosamente

        } catch (PDOException $error) {
            error_log("Error en userSignUp: " . $error->getMessage());
            return false;
        }
    }

    public function userLogin($username, $password) {
        if (!$this->exist($username)) {
            return false; // Usuario no existe
        }

        try {
            $sql = "SELECT id, password FROM User WHERE username = :username";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':username', $username);
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($password, $user->password)) {
                session_start();
                session_regenerate_id(true); // Evita secuestro de sesión

                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $username;

                return true; // Login exitoso
            } else {
                return false; // Credenciales incorrectas
            }

        } catch (PDOException $error) {
            error_log("Error en userLogin: " . $error->getMessage());
            return false;
        }
    }

    public function exist($username, $email = null) {
        try {
            if ($email === null) {
                $sql = "SELECT id FROM User WHERE username = :username";
                $statement = $this->connection->prepare($sql);
                $statement->bindValue(':username', $username);
            } else {
                $sql = "SELECT id FROM User WHERE username = :username OR email = :email";
                $statement = $this->connection->prepare($sql);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':email', $email);
            }

            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ) ? true : false;

        } catch (PDOException $error) {
            error_log("Error en exist: " . $error->getMessage());
            return false;
        }
    }

}
