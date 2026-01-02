<?php

    namespace App\Middlewares;

    class AuthMiddleware
    {
        public function validateRegistrationData()
        {

        }
        public function validateLogindata()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($username !== "antorKun" || $password !== "sillyGoober")
            {
                redirect("/expense-tracker/login");
            }
        }
    }

?>