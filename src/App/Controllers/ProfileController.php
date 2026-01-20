<?php
    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel};

    class ProfileController
    {
        private TemplateEngine $view;
        private Database $db;
        private AuthMiddleware $auth;

        public function __construct()
        {
            $this->view = new TemplateEngine(__DIR__ . "/../views");
            $this->db = new Database();
            $this->auth = new AuthMiddleware();
        }

        // 1. Dashboard / Overview
        public function indexView()
        {
            $this->auth->requireLogin();
            $user = $this->getUser();

            // Placeholders for counts (You can connect these to real Models later)
            $stats = [
                'logs_count' => 0,     // e.g. $logModel->countByUser($user['id'])
                'wishlist_count' => 0  // e.g. $wishlistModel->countByUser($user['id'])
            ];

            $this->view->addData('title', 'My Profile');
            echo $this->view->render("profile/index.php", ['user' => $user, 'stats' => $stats]);
        }

        // 2. My Travel Logs Page
        public function logsView()
        {
            $this->auth->requireLogin();
            $user = $this->getUser();

            $this->view->addData('title', 'My Travel Logs');
            echo $this->view->render("profile/logs.php", ['user' => $user]);
        }

        // 3. Wishlist Page
        public function wishlistView()
        {
            $this->auth->requireLogin();
            $user = $this->getUser();

            $this->view->addData('title', 'My Wishlist');
            echo $this->view->render("profile/wishlist.php", ['user' => $user]);
        }

        // 4. Settings Page
        public function settingsView()
        {
            $this->auth->requireLogin();
            $user = $this->getUser();

            $this->view->addData('title', 'Account Settings');
            echo $this->view->render("profile/settings.php", ['user' => $user]);
        }

        public function updatePassword()
        {
            $this->auth->requireLogin();
            $user = $this->getUser();

            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $conn = $this->db->connection();
            $userModel = new UserModel($conn);

            $hasError = false;

            if ($user['password'] !== $currentPassword) {
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

            $userModel->updatePassword((int)$user['id'], $newPassword);
            setFlash('success', "Password updated successfully!");
            redirect("/explored/profile/settings");
        }

        private function getUser()
        {
            $username = $_SESSION['auth']['user'];
            $conn = $this->db->connection();
            $userModel = new UserModel($conn);
            $user = $userModel->findByUsername($username);

            if (!$user) {
                logout();
            }
            return $user;
        }
    }
?>