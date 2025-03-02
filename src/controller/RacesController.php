<?php

class TeamsController {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public static function addRace($grand_prix, $race_date, $winner, $car, $laps) {
        $sql = "INSERT INTO races (grand_prix, race_date, winner, car, laps) 
                VALUES (:grand_prix, :race_date, :winner, :car, :laps)";
        $statement = self::connect()->prepare($sql);
        $statement->bindValue(':grand_prix', $grand_prix);
        $statement->bindValue(':race_date', $race_date);
        $statement->bindValue(':winner', $winner);
        $statement->bindValue(':car', $car);
        $statement->bindValue(':laps', $laps);
        return $statement->execute();
    }
    
    public static function editRace($id, $grand_prix, $race_date, $winner, $car, $laps) {
        $sql = "UPDATE races 
                SET grand_prix = :grand_prix, race_date = :race_date, winner = :winner, 
                    car = :car, laps = :laps 
                WHERE id = :id";
        $statement = self::connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':grand_prix', $grand_prix);
        $statement->bindValue(':race_date', $race_date);
        $statement->bindValue(':winner', $winner);
        $statement->bindValue(':car', $car);
        $statement->bindValue(':laps', $laps);
        return $statement->execute();
    }
    
    public static function deleteRace($id) {
        $sql = "DELETE FROM races WHERE id = :id";
        $statement = self::connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
    
    public static function getRaceById($id) {
        $sql = "SELECT * FROM races WHERE id = :id";
        $statement = self::connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}