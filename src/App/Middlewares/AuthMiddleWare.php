<?php

    namespace App\Middlewares;
    use App\Model\UserModel;
    class AuthMiddleware
    {
        public function requireLogin()
        {
            if (!isLoggedIn()) {
                redirect("/explored/login");
            }
        }
        
        public function requireAdmin()
        {
            $this->requireLogin();

            if ($_SESSION['auth']['role'] !== 'admin') {
                setFlash('message', "You don't have permission to access this page.");
                redirect("/explored");
            }
        }

        
    }

?>