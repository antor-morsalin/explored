<?php
declare(strict_types=1);
include __DIR__."/data.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "", 3306);


$conn->query("CREATE DATABASE IF NOT EXISTS explored");
$conn->set_charset("utf8mb4");
$conn->select_db("explored");

// ✨ FIX: Drop 'travel_logs' FIRST because it references 'users'
$conn->query("DROP TABLE IF EXISTS travel_logs");

// TABLE 1: USERS (With Role)
$conn->query("DROP TABLE IF EXISTS users");
$conn->query("
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
    )
");

$statement = $conn->prepare(
    "INSERT INTO users (username, password, role) VALUES (?, ?, ?)"
);

foreach ($users as [$username, $password, $role]) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $statement->bind_param("sss", $username, $hashedPassword, $role);
    $statement->execute();
}

// TABLE 2: CONTACT MESSAGES
$conn->query("DROP TABLE IF EXISTS contact_messages");
$conn->query("
    CREATE TABLE contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$stmt_msg = $conn->prepare(
    "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)"
);

foreach ($contact_messages as [$name, $email, $subject, $message]) {
    $stmt_msg->bind_param("ssss", $name, $email, $subject, $message);
    $stmt_msg->execute();
}

// TABLE 3: TRAVEL LOGS
// (Drop statement removed from here since we moved it to the top)
$conn->query("
    CREATE TABLE travel_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        owner_id INT NOT NULL,
        title VARCHAR(150) NOT NULL,
        description TEXT NOT NULL,
        journey_type VARCHAR(50) NOT NULL,
        published TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

        CONSTRAINT ownership
            FOREIGN KEY (owner_id)
            REFERENCES users(id)
            ON DELETE CASCADE
    ) ENGINE=InnoDB
");

$statement = $conn->prepare(
    "INSERT INTO travel_logs (owner_id, title, description, journey_type)
     VALUES (?, ?, ?, ?)"
);

foreach ($travel_logs as [$owner_id, $title, $description, $journey_type]) {
    $statement->bind_param("isss", $owner_id, $title, $description, $journey_type);
    $statement->execute();
}

echo "Seeding completed successfully!\n";
echo "- 'users' table created with 'role' column.\n";
echo "- 'contact_messages' table created.\n";
echo "- 'travel_logs' table created.\n";
?>