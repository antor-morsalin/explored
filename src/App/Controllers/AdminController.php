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

        public function dashboard()
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
            echo $this->view->render("admin/dashboard.php", ['stats' => $stats]);
        }

        public function messages()
        {
            $this->auth->requireAdmin();

            $conn = $this->db->connection();
            $messageModel = new MessageModel($conn);
            
            $messages = $messageModel->findAll();

            $this->view->addData('title', 'Admin Inbox');
            echo $this->view->render("admin/messages.php", ['messages' => $messages]);
        }


        public function users()
        {
            $this->auth->requireAdmin();

            $conn = $this->db->connection();
            $userModel = new UserModel($conn);

            $users = $userModel->findAll();

            $this->view->addData('title', 'User Management');
            echo $this->view->render("admin/users.php", ['users' => $users]);
        }


        public function deleteUser()
        {
            $this->auth->requireAdmin();

            $id = (int) ($_POST['id'] ?? 0);
            
            if ($id) {
                $conn = $this->db->connection();
                $userModel = new UserModel($conn);
                
                // 1. Fetch the user details first
                $userToDelete = $userModel->find($id);

                if ($userToDelete) {
                    // 2. Security Check: Is this user an admin?
                    if ($userToDelete['role'] === 'admin') {
                        setFlash('error', "You cannot ban another Admin!");
                        redirect("/explored/admin/users");
                        return; // Stop execution
                    }

                    // 3. Prevent deleting yourself (extra safety)
                    if ($_SESSION['auth']['user'] === $userToDelete['username']) {
                        setFlash('error', "You cannot ban yourself!");
                        redirect("/explored/admin/users");
                        return;
                    }

                    // 4. Safe to delete
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