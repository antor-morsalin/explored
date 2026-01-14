<?php
declare(strict_types=1);
include __DIR__."/userdata.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "", 3306);

$conn->query("CREATE DATABASE IF NOT EXISTS explored");
$conn->set_charset("utf8mb4");



$conn -> select_db("explored");

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

echo "Seeding completed";

?>