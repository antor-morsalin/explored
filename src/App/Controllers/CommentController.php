<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\{Database, CommentModel};
    use App\Middlewares\AuthMiddleware;

    class CommentController
    {   
        private TemplateEngine $view;  
        private CommentModel $commentModel;
        private AuthMiddleware $authMiddleware;

        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $db = new Database();
            $conn = $db -> connection();
            $this -> commentModel = new CommentModel($conn);
            $this -> authMiddleware = new AuthMiddleware();
        }

        public function postComment()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $comment = $_POST['comment'];
            $logId = $_GET['params']['id'];
            
            if (!isLoggedIn()) 
            {
                setFlash('error', 'Only a valid user can comment on the post');
                redirect("/explored/logs/{$logId}");
                return;
            }

            $comment = $_POST['comment'];
            $userId = getAuth('userId');
            $this -> commentModel -> saveComment($userId, $comment, $logId);
            setFlash('success', 'Comment posted successfully');
            redirect("/explored/logs/{$logId}");
        }

        public function deleteComment()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $commentId = $_GET['params']['id'];
            $comment = $this -> commentModel -> getComment($commentId);

            $this -> authMiddleware -> isCommentOwner($comment, getAuth('userId'));

            $this -> commentModel -> deleteComment($commentId);
            $logId = $comment['log_id'];
            redirect("/explored/logs/{$logId}");
        }
    }
?>