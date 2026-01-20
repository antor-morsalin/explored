<?php
    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Middlewares\AuthMiddleware;
    use App\Model\{Database, UserModel, MessageModel};
    use mysqli;

    class AdminController
    {
        private TemplateEngine $view;
        private AuthMiddleware $authMiddleWare; 
        private mysqli $conn;

        public function __construct()
        {
            $this->view = new TemplateEngine(__DIR__ . "/../views");
            $this->authMiddleWare = new AuthMiddleware(); 
            $this->authMiddleWare->requireAdmin(); 
            $db = new Database();
            $this->conn = $db->connection();
        }

        public function dashboardView()
        {
            $userModel = new UserModel($this->conn);
            $messageModel = new MessageModel($this->conn);

            $stats = [
                'total_users' => $userModel->countAll(),
                'total_messages' => $messageModel->countAll()
            ];

            $this->view->addData('title', 'Admin Dashboard');
            
            // 3. Use helper method to render
            $this->renderAdminView("admin/dashboard.php", ['stats' => $stats]);
        }

        public function messagesView()
        {
            $messageModel = new MessageModel($this->conn);
            $messages = $messageModel->findAll();

            $this->view->addData('title', 'Admin Inbox');
            $this->renderAdminView("admin/messages.php", ['messages' => $messages]);
        }

        public function usersView()
        {
            $userModel = new UserModel($this->conn);
            $users = $userModel->findAll();

            $this->view->addData('title', 'User Management');
            $this->renderAdminView("admin/users.php", ['users' => $users]);
        }

        public function deleteUser()
        {
            // Note: $this->authMiddleWare->requireAdmin() is already called in __construct

            $id = (int) ($_POST['id'] ?? 0);
            
            if ($id) {
                $userModel = new UserModel($this->conn);
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

        /**
         * Helper function to render admin views with standard flags
         */
        private function renderAdminView(string $path, array $data = [])
        {
            $adminFlags = [
                'hideNavigation' => true,
                'hideFooter' => true
            ];
            
            echo $this->view->render($path, array_merge($data, $adminFlags));
        }
    }
?>