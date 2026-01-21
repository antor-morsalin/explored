<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class LogModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }

        public function saveLog(mixed $ownerId, string $title, string $description, string $journeyType)
        {
            $statement = $this->conn->prepare(
                "INSERT INTO travel_logs (owner_id, title, description, journey_type)
                VALUES (?, ?, ?, ?)"
            );

            $statement->bind_param(
                "isss",
                $ownerId,
                $title,
                $description,
                $journeyType
            );

            $statement->execute();
        }

        public function getTotalLogs()
        {

            $userId = (int) getAuth('userId');

            $statement = $this->conn->prepare("SELECT COUNT(*) AS total FROM travel_logs WHERE owner_id = ?");

            $statement->bind_param("i", $userId);
            $statement->execute();

            $result = $statement->get_result()->fetch_assoc();

            return (int) $result['total'];
        }

        public function getAllLogs()
        {
            $userId = (int) getAuth('userId');

            $statement = $this->conn->prepare(
                "SELECT id, owner_id, title, description, journey_type, published, created_at
                FROM travel_logs
                WHERE owner_id = ?
                ORDER BY created_at DESC"
            );

            $statement->bind_param("i", $userId);
            $statement->execute();

            $result = $statement->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getLog(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT id, owner_id, title, description, journey_type, published, created_at
                FROM travel_logs
                WHERE id = ?
                LIMIT 1"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

            $result = $statement->get_result()->fetch_assoc();

            return $result ;
        }


    }
    
?>