<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class MessageModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }

        public function countAll(): int
        {
            $sql = "SELECT COUNT(*) as total FROM contact_messages";
            $result = $this->conn->query($sql);
            return (int) $result->fetch_assoc()['total'];
        }

        public function findAll(): array
        {
            $sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
            $result = $this->conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>