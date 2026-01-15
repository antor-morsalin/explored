<?php
declare(strict_types=1);
include __DIR__."/userdata.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "", 3306);

$conn->query("CREATE DATABASE IF NOT EXISTS explored");
$conn->set_charset("utf8mb4");



$conn -> select_db("explored");

// table1 - users
$conn->query("DROP TABLE IF EXISTS users");

$conn->query("
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )
");

$statement = $conn->prepare(
    "INSERT INTO users (username, password) VALUES (?, ?)"
);

foreach ($users as [$username, $password]) {
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
}

// table2 = contact messages

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

echo "Seeding completed";
echo "- 'users' table created and populated.\n";
echo "- 'contact_messages' table created and populated with " . count($contact_messages) . " messages.\n";
?>