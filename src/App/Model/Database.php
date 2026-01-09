<?php
    declare(strict_types=1);
    namespace App\Model;

    use mysqli;

    class Database
    {
        private mysqli $conn;

        public function __construct()
        {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this -> conn = new mysqli("localhost", "root", "", "explored", 3306);
            $this -> conn -> set_charset("utf8mb4");
        }
        public function connection() : mysqli
        {
            return $this -> conn;   
        }
    }

?>