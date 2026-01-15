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
    }
?>