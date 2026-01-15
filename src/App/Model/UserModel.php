<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class UserModel
    {
        private mysqli $conn;

        public function __construct(mysqli $conn)
        {
            $this -> conn = $conn;
        }

        public function register(string $username, string $password)
        {
            $statement = $this->conn->prepare(
                "INSERT INTO users (username, password) VALUES (?, ?)"
            );
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
        }

        public function login(string $username, string $password)
        {
            $statement = $this->conn->prepare(
                "SELECT * FROM users WHERE username = ? AND password = ?"
            );
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            $result = $statement->get_result();

            if ($result->num_rows === 1) {
                return $result->fetch_assoc();
            }

            return false;
        }
        
        public function usernameExists(string $username): bool
        {
            $statement = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
            $statement->bind_param("s", $username);
            $statement->execute();
            $statement->store_result();
            return $statement->num_rows > 0;
        }


        public function countAll(): int
        {
            $sql = "SELECT COUNT(*) as total FROM users";
            $result = $this->conn->query($sql);
            return (int) $result->fetch_assoc()['total'];
        }
    }
// No closing tag
?>