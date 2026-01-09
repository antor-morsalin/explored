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
        public function register()
        {
            echo "registration Completed";
        }
    }

?>