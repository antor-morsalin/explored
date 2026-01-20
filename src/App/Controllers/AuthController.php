<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel};
    use mysqli;
    class AuthController
    {   
        private TemplateEngine $view;  
        private UserModel $userModel;
        private mysqli $conn;
        
        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $db = new Database();
            $this -> conn = $db -> connection();
            $this -> userModel = new UserModel($this -> conn);
        }

        public function registerView()
        {
            $this -> view -> addData('title', 'Registration');
            echo $this -> view -> render("register.php");
        }

        public function register()
        {
            $this -> userModel -> register($_POST['username'], $_POST['password']);
            setAuth('role', 'user');
            setAuth('user', $_POST['username']);
            setFlash('message', "Welcome {$_POST['username']}, login to Explored!");
            redirect("/explored/login");
        }

        public function loginView()
        {
            $this -> view -> addData('title', 'Login');
            echo $this -> view -> render("login.php");
        }

        public function login()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this -> userModel -> login($username, $password);

            if(!$user) {
                setFlash('message', "Invalid username or password");
                redirect("/explored/login");
            }
            
            setFlash('message', "Welcome back {$user['username']}");
            setAuth('user', $user['username']);
            setAuth('role', $user['role']); 
            
            if ($user['role'] === 'admin') {
                redirect("/explored/admin/dashboard"); 
            } else {
                redirect("/explored/profile");
            }
        }

        public function privacyPolicyView() {
            $this->view->addData('title', 'Privacy Policy');
            echo $this->view->render("privacy-policy.php");
        }

        public function termsAndConditionsView() {
            $this -> view -> addData('title', 'Terms and Conditions');
            echo $this -> view -> render("terms-and-conditions.php");
        }

        public function checkUsername()
        {
            $username = $_GET['username'] ?? '';
            $exists = $this->userModel->usernameExists($username);
            
            header('Content-Type: application/json');
            echo json_encode(['available' => !$exists]);
            exit;
        }

        public function logout() 
        {
            logout();
        }
    }
?>