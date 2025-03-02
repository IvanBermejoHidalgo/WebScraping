<?php

class RacesController {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    // Añadir una carrera
    public static function addRace($grand_prix, $race_date, $winner, $car, $laps) {
        $sql = "INSERT INTO races (grand_prix, race_date, winner, car, laps) 
                VALUES (:grand_prix, :race_date, :winner, :car, :laps)";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':grand_prix', $grand_prix);
        $statement->bindValue(':race_date', $race_date);
        $statement->bindValue(':winner', $winner);
        $statement->bindValue(':car', $car);
        $statement->bindValue(':laps', $laps);
        return $statement->execute();
    }

    // Editar una carrera
    public static function editRace($id, $grand_prix, $race_date, $winner, $car, $laps) {
        $sql = "UPDATE races 
                SET grand_prix = :grand_prix, race_date = :race_date, winner = :winner, 
                    car = :car, laps = :laps 
                WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':grand_prix', $grand_prix);
        $statement->bindValue(':race_date', $race_date);
        $statement->bindValue(':winner', $winner);
        $statement->bindValue(':car', $car);
        $statement->bindValue(':laps', $laps);
        return $statement->execute();
    }

    // Eliminar una carrera
    public static function deleteRace($id) {
        $sql = "DELETE FROM races WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    // Obtener una carrera por ID
    public static function getRaceById($id) {
        $sql = "SELECT * FROM races WHERE id = :id";
        $statement = (new self)->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}