<?php
    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel, MessageModel};

    class AdminController
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

        // ✨ FIX: Renamed to dashboardView and passing hide flags
        public function dashboardView()
        {
            $this->auth->requireAdmin();

            $conn = $this->db->connection();
            $userModel = new UserModel($conn);
            $messageModel = new MessageModel($conn);

            $stats = [
                'total_users' => $userModel->countAll(),
                'total_messages' => $messageModel->countAll()
            ];

            $this->view->addData('title', 'Admin Dashboard');
            // Pass the flags here
            echo $this->view->render("admin/dashboard.php", [
                'stats' => $stats,
                'hideNavigation' => true,
                'hideFooter' => true
            ]);
        }

        // ✨ FIX: Renamed to messagesView and passing hide flags
        public function messagesView()
        {
            $this->auth->requireAdmin();

            $conn = $this->db->connection();
            $messageModel = new MessageModel($conn);
            
            $messages = $messageModel->findAll();

            $this->view->addData('title', 'Admin Inbox');
            // Pass the flags here
            echo $this->view->render("admin/messages.php", [
                'messages' => $messages,
                'hideNavigation' => true,
                'hideFooter' => true
            ]);
        }

        // ✨ FIX: Renamed to usersView and passing hide flags
        public function usersView()
        {
            $this->auth->requireAdmin();

            $conn = $this->db->connection();
            $userModel = new UserModel($conn);

            $users = $userModel->findAll();

            $this->view->addData('title', 'User Management');
            // Pass the flags here
            echo $this->view->render("admin/users.php", [
                'users' => $users,
                'hideNavigation' => true,
                'hideFooter' => true
            ]);
        }

        public function deleteUser()
        {
            $this->auth->requireAdmin();

            $id = (int) ($_POST['id'] ?? 0);
            
            if ($id) {
                $conn = $this->db->connection();
                $userModel = new UserModel($conn);
                
                $userToDelete = $userModel->find($id);

                if ($userToDelete) {
                    if ($userToDelete['role'] === 'admin') {
                        setFlash('error', "You cannot ban another Admin!");
                        redirect("/explored/admin/users");
                        return; 
                    }

                    if ($_SESSION['auth']['user'] === $userToDelete['username']) {
                        setFlash('error', "You cannot ban yourself!");
                        redirect("/explored/admin/users");
                        return;
                    }

                    $userModel->delete($id);
                    setFlash('success', "User '{$userToDelete['username']}' has been banned.");
                } else {
                    setFlash('error', "User not found.");
                }
            }

            redirect("/explored/admin/users");
        }
    }
?>