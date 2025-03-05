<?php

class DriversController {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public static function addDriver($first_name, $last_name, $team, $country, $flag_url, $piloto_img) {
        $sql = "INSERT INTO drivers (first_name, last_name, team_name, country, flag_url, piloto_img) 
                VALUES (:first_name, :last_name, :team_name, :country, :flag_url, :piloto_img)";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':team_name', $team);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':flag_url', $flag_url);
        $statement->bindValue(':piloto_img', $piloto_img);
        return $statement->execute();
    }
    
    public static function editDriver($id, $first_name, $last_name, $team, $country, $flag_url, $piloto_img) {
        $sql = "UPDATE drivers 
                SET first_name = :first_name, last_name = :last_name, team_name = :team_name, 
                    country = :country, flag_url = :flag_url, piloto_img = :piloto_img 
                WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':team_name', $team);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':flag_url', $flag_url);
        $statement->bindValue(':piloto_img', $piloto_img);
        return $statement->execute();
    }

    public static function deleteDriver($id) {
        $sql = "DELETE FROM drivers WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function getDriverById($id) {
        $sql = "SELECT * FROM drivers WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}