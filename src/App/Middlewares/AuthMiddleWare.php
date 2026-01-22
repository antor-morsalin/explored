<?php

    namespace App\Middlewares;
    use App\Model\UserModel;
    class AuthMiddleware
    {
        public function requireLogin()
        {
            if (!isLoggedIn()) 
            {
                setFlash('error', "You have to be logged in to perform this action");
                redirect("/explored/login");
            }
        }

        public function requireNotLoggedIn()
        {
            if(isLoggedIn())
            {
                setFlash('error', "Can not perform this action while logged in.");
                redirect("/explored/logs");
            }
        }

        public function requireUser()
        {
            if ($_SESSION['auth']['role'] !== 'user') 
            {
                setFlash('message', "You don't have permission to access this page.");
                redirect("/explored");
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

        public function isCommentOwner(mixed $comment, mixed $ownerId)
        {
            if($comment['owner_id'] != $ownerId)
            {
                setFlash('error', "You don't have permission to perform this action");
                redirect("/explored");               
            }
        }

        
    }

?>