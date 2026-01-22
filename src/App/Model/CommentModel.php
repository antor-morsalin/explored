<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class CommentModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }
        public function saveComment(mixed $ownerId, string $comment, mixed $logId)
        {
            $statement = $this->conn->prepare(
                "INSERT INTO comments (owner_id, log_id, comment)
                VALUES (?, ?, ?)"
            );

            $statement->bind_param("iis", $ownerId, $logId, $comment);

            $statement->execute();
        }

        public function getAllComments(mixed $logId)
        {
            $statement = $this->conn->prepare(
                "SELECT * FROM comments WHERE log_id = ? ORDER BY created_at DESC"
            );

            $statement->bind_param("i", $logId);
            $statement->execute();

            $result = $statement->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getComment(mixed $commentId)
        {
            $statement = $this->conn->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1");
            $statement->bind_param("i", $commentId);
            $statement->execute();

            $result = $statement->get_result()->fetch_assoc();

            return $result ;
        }

        public function deleteComment(mixed $commentId)
        {
            $statement = $this->conn->prepare("DELETE FROM comments WHERE id = ? LIMIT 1");
            $statement->bind_param("i", $commentId);
            $statement->execute();
        }

    }
    
?>