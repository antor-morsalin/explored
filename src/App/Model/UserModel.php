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
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $statement = $this->conn->prepare(
                "INSERT INTO users (username, password) VALUES (?, ?)"
            );
            $statement->bind_param("ss", $username, $hashedPassword);
            $statement->execute();
        }

        public function login(string $username, string $password)
        {
            $statement = $this->conn->prepare(
                "SELECT * FROM users WHERE username = ?"
            );
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if(password_verify($password, $user['password'])) {
                    return $user;
                }
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

        public function findAll(): array
        {
            $sql = "SELECT * FROM users";
            $result = $this->conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function find(int $id): ?array
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_assoc() ?: null;
        }

        
        public function delete(int $id)
        {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }

        public function findByUsername(string $username): ?array
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc() ?: null;
        }

        public function updatePassword(int $id, string $newPassword)
        {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashedPassword, $id);
            $stmt->execute();
        }
    }
    
?>