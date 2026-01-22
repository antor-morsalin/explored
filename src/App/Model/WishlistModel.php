<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class WishlistModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }

        public function addToWishlist(mixed $userId, mixed $logId)
        {
            $statement = $this->conn->prepare(
                "INSERT INTO wishlist (user_id, log_id) VALUES (?, ?)"
            );

            $statement->bind_param("ii", $userId, $logId);
            $statement->execute();
        }

        public function getAllLogsId(mixed $userId)
        {
            $statement = $this->conn->prepare(
                "SELECT log_id
                FROM wishlist
                WHERE user_id = ?"
            );

            $statement->bind_param("i", $userId);
            $statement->execute();

            $result = $statement->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function onWishList(mixed $userId, mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT id
                FROM wishlist
                WHERE user_id = ? AND log_id = ?"
            );

            $statement->bind_param("ii", $userId, $logId);
            $statement->execute();

            $result = $statement->get_result();

            return $result->num_rows === 1 ? 1 : 0;
        }

        public function removeFromWishlist(mixed $userId, mixed $logId)
        {
            $statement = $this->conn->prepare(
                "DELETE FROM wishlist
                WHERE user_id = ? AND log_id = ?"
            );

            $statement->bind_param("ii", $userId, $logId);
            $statement->execute();
        }

    }
    
?>