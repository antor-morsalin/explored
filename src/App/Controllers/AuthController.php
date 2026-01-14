<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel};

    class AuthController
    {   
        private TemplateEngine $view ;  
        private AuthMiddleware $authMiddleware;
        private Database $db;
        private UserModel $userModel;
        
        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> authMiddleware = new AuthMiddleware();

            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> userModel = new UserModel($conn);
        }

        public function registerView()
        {
            // I wonder ekhane middleware gula boshabo naki
            $this -> view -> addData('title', 'Registration');
            echo $this -> view -> render("register.php");
        }

        public function register()
        {
            $this -> userModel -> register($_POST['username'], $_POST['password']);
            setAuth('role', 'user');
            setAuth('user', $_POST['username']);
            setFlash('message', "Welcome to Explored {$_POST['username']}");
            redirect("/explored");
        }

        public function loginView()
        {
            // I wonder ekhane middleware gula boshabo naki
            $this -> view -> addData('title', 'Login');
            echo $this -> view -> render("login.php");
        }

        public function login()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $valid = $this -> userModel -> login($username, $password);

            if(!$valid) {
                setFlash('message', "Invalid username or password");
                redirect("/explored/login");
            }

            setFlash('message', "Welcome back {$_POST['username']}") ;
            setAuth('user', $_POST['username']);
            setAuth('role', 'user');
            redirect("/explored");
        }

        public function termsAndConditionsView() {
            $this -> view -> addData('title', 'Terms and Conditions');
            echo $this -> view -> render("terms-and-conditions.php");
        }




    }


?>