<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;

    class AuthController
    {   
        private TemplateEngine $view ;  
        private AuthMiddleware $authMiddleware;
        
        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> authMiddleware = new AuthMiddleware();
        }

        public function registerView()
        {
            // I wonder ekhane middleware gula boshabo naki
            $this -> view -> addData('title', 'Registration');
            echo $this -> view -> render("register.php");
        }

        public function register()
        {
            dd($_POST);
        }

        public function loginView()
        {
            // I wonder ekhane middleware gula boshabo naki
            $this -> view -> addData('title', 'Login');
            echo $this -> view -> render("login.php");
        }

        public function login()
        {
            $this -> authMiddleware -> validateLogindata();
            setFlash('message', "Welcome back {$_POST['username']}") ;
            setAuth('user', $_POST['username']);
            redirect("/explored");
        }
    }


?>