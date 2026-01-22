<?php
    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel};
    use mysqli;
    class ProfileController
    {
        private TemplateEngine $view;
        private AuthMiddleware $authMiddleWare;
        private mysqli $conn;
        private array $user;

        public function __construct()
        {
            $this->view = new TemplateEngine(__DIR__ . "/../views");
            $this->authMiddleWare = new AuthMiddleware();
            $this->authMiddleWare->requireLogin();
            $db = new Database();
            $this->conn = $db->connection();
            $this->user = $this->fetchCurrentUser();
        }
        
        public function logsView()
        {
            $this->view->addData('title', 'My Travel Logs');
            echo $this->view->render("profile/logs.php", ['user' => $this->user]);
        }
        
        public function settingsView()
        {
            $this->view->addData('title', 'Account Settings');
            echo $this->view->render("profile/settings.php", ['user' => $this->user]);
        }

        public function updatePassword()
        {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $userModel = new UserModel($this->conn);

            $hasError = false;

            if (!password_verify($currentPassword, $this->user['password'])) {
                setFlash('error_current_password', "Incorrect current password.");
                $hasError = true;
            }

            if (strlen($newPassword) < 8) {
                setFlash('error_new_password', "Password must be at least 8 characters.");
                $hasError = true;
            }

            if ($newPassword !== $confirmPassword) {
                setFlash('error_confirm_password', "Passwords do not match.");
                $hasError = true;
            }

            if ($hasError) {
                redirect("/explored/profile/settings"); 
                return;
            }

            $userModel->updatePassword((int)$this->user['id'], $newPassword);
            setFlash('success', "Password updated successfully!");
            redirect("/explored/profile/settings");
        }

       

        private function fetchCurrentUser()
        {
            $username = $_SESSION['auth']['user'];
            $userModel = new UserModel($this->conn);
            $user = $userModel->findByUsername($username);
            if(!$user) {
                logout();
            }
            return $user;
        }
    }
?>