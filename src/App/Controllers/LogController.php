<?php 

    declare(strict_types=1);

    namespace App\Controllers;


use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogModel, LogSectionModel, UserModel, CommentModel, WishlistModel};
    use App\Middlewares\{AuthMiddleware, LogMiddleWare};

    class LogController
    {
        private TemplateEngine $view ;
        private Database $db;
        private UserModel $userModel;
        private LogModel $logModel;
        private LogSectionModel $logSectionModel;
        private CommentModel $commentModel;
        private LogMiddleWare $logMiddleWare;
        private WishlistModel $wishlistModel;
        private AuthMiddleware $authMiddleware;


        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> userModel = new UserModel($conn);
            $this -> logModel = new LogModel($conn);
            $this -> logSectionModel = new LogSectionModel($conn);
            $this -> commentModel = new CommentModel($conn);
            $this -> logMiddleWare = new LogMiddleWare();
            $this -> wishlistModel = new WishlistModel($conn);
            $this -> authMiddleware = new AuthMiddleware();
        }

        public function logsView()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $this -> view -> addData('title', 'Logs');
            $totalLogs = $this -> logModel -> getTotalLogs();
            $this -> view -> addData('totalLogs', $totalLogs);

            $logs = $this -> logModel -> getAllLogs();
            $this -> view -> addData('logs', $logs);
            echo $this -> view -> render("logs.php");
        }

        public function createLogView()
        {   
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $this -> view -> addData('title', 'Create Logs');
            echo $this -> view -> render("createLog.php");
        }

        public function postLog()  
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $this -> logMiddleWare -> validateLogData();

            $ownerId = getAuth('userId');
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $journeyType = trim($_POST['journey_type']);

            $this->logModel->saveLog($ownerId, $title, $description, $journeyType);

            setFlash('success', 'You successfully created a travel log');
            redirect('/explored/logs');
        }

        private function getFullLog()
        {
            $logId = $_GET['params']['id'];
            $log = $this -> logModel -> getLog($logId);

            if(!$log) redirect('/explored/explore');
            $ownerName = $this -> userModel -> getUserName($log['owner_id']);
            $log['ownerName'] = $ownerName;
            return $log;
        }

        public function logView()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $this -> view -> addData('title', 'Log');
            $log = $this -> getFullLog();

            $currentUserId = getAuth('userId'); // Returns null if guest
            
            if ($log['published'] == 0 && $log['owner_id'] !== $currentUserId) {
                setFlash('error', 'This log is private or does not exist.');
                redirect('/explored/explore');
                return;
            }

            $this -> view -> addData('log', $log);
            $logId = $_GET['params']['id'];

            $logSections = $this -> logSectionModel -> getAllLogSections($logId);
            $this -> view -> addData('logSections', $logSections);

            $avgCost = $this -> logModel -> getAvgCost($logId);
            $this -> view -> addData('avgCost', $avgCost);

            $comments = $this -> commentModel -> getAllComments($logId);
            foreach($comments as &$comment)
            {
                $comment['ownerName'] = $this -> userModel -> getUserName($comment['owner_id']);
            }
            $this -> view -> addData('comments', $comments);

            $avgRating = $this -> logModel -> getAvgRating($logId);
            $this -> view -> addData('avgRating', round((float)$avgRating) );

            $onWishlist = $this -> wishlistModel -> onWishList(getAuth('userId'), $logId);
            $this -> view -> addData('onWishlist', $onWishlist);

            echo $this -> view -> render("log.php");
        }

        public function publishLog()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();   
            $logId = $_GET['params']['id'];
            $this -> logModel -> publishLog($logId);
            setFlash('success', "Your travel log was published and now all users can see it");
            redirect("/explored/logs/{$logId}");
        }

        public function exploreView()
        {
            $logs = $this->logModel->exploreLogs(
                $_GET['search'] ?? null,
                $_GET['sort'] ?? null
            );

            foreach ($logs as &$log)
            {
                $log['avgCost'] = $this->logModel->getAvgCost($log['id']);
                $log['avgRating'] = round((float) $this->logModel->getAvgRating($log['id']));
                $log['ownerName'] = $this->userModel->getUserName($log['owner_id']);
            }

            $this->view->addData('title', "Explore");
            $this->view->addData('logs', $logs);
            echo $this->view->render("explore.php");
        }



    
    }


?>