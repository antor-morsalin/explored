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

            $statement->bind_param("isss", $ownerId, $title, $description, $journeyType);

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

        public function publishLog(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "UPDATE travel_logs
                SET published = 1
                WHERE id = ?"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

        }

        public function getAvgCost(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT SUM(avg_cost) AS total_cost
                FROM log_sections
                WHERE log_id = ?"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

            $result = $statement->get_result()->fetch_assoc();

            if ($result['total_cost'] === null) {
                return 0;
            }

            return $result['total_cost'];
        }

        public function exploreLogs($search = null, $sort = null)
        {
            $query = "SELECT id, owner_id, title, description, journey_type, published, created_at
                    FROM travel_logs
                    WHERE published = 1";

            $params = [];
            $types  = "";

            if ($search) 
            {
                $query .= " AND (title LIKE ? OR description LIKE ? OR journey_type LIKE ?)";
                $like = "%{$search}%";
                array_push($params, $like, $like, $like);
                $types = "sss";
            }

            if ($sort === "oldest") 
            {
                $query .= " ORDER BY created_at ASC";
            }

            if (!$sort || $sort === "newest") 
            {
                $query .= " ORDER BY created_at DESC";
            }

            $statement = $this->conn->prepare($query);

            if ($params) 
            {
                $statement->bind_param($types, ...$params);
            }

            $statement->execute();
            $result = $statement->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }


        public function findAllForAdmin()
        {
            // Fetch logs WITH the username of the owner
            $sql = "SELECT l.*, u.username 
                    FROM travel_logs l 
                    JOIN users u ON l.owner_id = u.id 
                    ORDER BY l.created_at DESC";
            
            $result = $this->conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function delete(int $id)
        {
            $statement = $this->conn->prepare("DELETE FROM travel_logs WHERE id = ?");
            $statement->bind_param("i", $id);
            $statement->execute();
        }

        public function countAll(): int
        {
            $sql = "SELECT COUNT(*) as total FROM travel_logs";
            $result = $this->conn->query($sql);
            return (int) $result->fetch_assoc()['total'];
        }

        public function getAvgRating(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT AVG(rating) AS avg_rating 
                FROM log_sections 
                WHERE log_id = ?"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

            $result = $statement->get_result()->fetch_assoc();
            
            if(!$result['avg_rating'])
            {
                return 0 ;
            }

            return $result['avg_rating'] ;
        }

    }
    
?>