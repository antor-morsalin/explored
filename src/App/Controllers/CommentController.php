<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\{Database, CommentModel};

    class CommentController
    {   
        private TemplateEngine $view;  
        private CommentModel $commentModel;
        
        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $db = new Database();
            $conn = $db -> connection();
            $this -> commentModel = new CommentModel($conn);
        }

        public function postComment()
        {
            $comment = $_POST['comment'];
            $logId = $_GET['params']['id'];
            $userId = getAuth('userId');
            $this -> commentModel -> saveComment($userId, $comment, $logId);
            setFlash('success', 'Comment posted successfully');
            redirect("/explored/logs/{$logId}");
        }
    }
?>