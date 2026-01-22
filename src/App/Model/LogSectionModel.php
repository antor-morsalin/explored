<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class LogSectionModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }

        public function saveLogSection(mixed $ownerId, mixed $logId, string $placeName, string $placeType,string $mapLink, mixed $avgCost, mixed $rating
        ) 
        {
            $statement = $this->conn->prepare(
                "INSERT INTO log_sections (owner_id, log_id, place_name, place_type, map_link, avg_cost, rating)
                VALUES (?, ?, ?, ?, ?, ?, ?)"
            );

            $statement->bind_param("iisssdi", $ownerId, $logId, $placeName, $placeType, $mapLink, $avgCost, $rating);

            $statement->execute();
        }

        public function getAllLogSections(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT id, owner_id, log_id, place_name, place_type, map_link, avg_cost, rating, created_at
                FROM log_sections
                WHERE log_id = ?
                ORDER BY created_at DESC"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

            return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        }

    }
    
?>