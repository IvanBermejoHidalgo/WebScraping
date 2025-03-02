<?php

class TeamsController {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    // Añadir un equipo
    public static function addTeam($team_name, $driver1, $driver2, $img_team, $img_car) {
        $sql = "INSERT INTO teams (team_name, driver1, driver2, img_team, img_car) 
                VALUES (:team_name, :driver1, :driver2, :img_team, :img_car)";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':team_name', $team_name);
        $statement->bindValue(':driver1', $driver1);
        $statement->bindValue(':driver2', $driver2);
        $statement->bindValue(':img_team', $img_team);
        $statement->bindValue(':img_car', $img_car);
        return $statement->execute();
    }

    // Editar un equipo
    public static function editTeam($id, $team_name, $driver1, $driver2, $img_team, $img_car) {
        $sql = "UPDATE teams 
                SET team_name = :team_name, driver1 = :driver1, driver2 = :driver2, 
                    img_team = :img_team, img_car = :img_car 
                WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':team_name', $team_name);
        $statement->bindValue(':driver1', $driver1);
        $statement->bindValue(':driver2', $driver2);
        $statement->bindValue(':img_team', $img_team);
        $statement->bindValue(':img_car', $img_car);
        return $statement->execute();
    }

    // Eliminar un equipo
    public static function deleteTeam($id) {
        $sql = "DELETE FROM teams WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    // Obtener un equipo por ID
    public static function getTeamById($id) {
        $sql = "SELECT * FROM teams WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}