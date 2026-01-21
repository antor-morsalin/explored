<?php 

    declare(strict_types=1);

    namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogModel, LogSectionModel, UserModel, CommentModel};
    use App\Middlewares\LogMiddleWare;

    class LogController
    {
        private TemplateEngine $view ;
        private Database $db;
        private UserModel $userModel;
        private LogModel $logModel;
        private LogSectionModel $logSectionModel;
        private CommentModel $commentModel;
        private LogMiddleWare $logMiddleWare;
        private AuthMiddleware $authMiddleWare;


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
            $this -> authMiddleWare = new AuthMiddleWare();
        }

        public function logsView()
        {
            $this -> authMiddleWare -> requireLogin();
            $this -> view -> addData('title', 'Logs');
            $totalLogs = $this -> logModel -> getTotalLogs();
            $this -> view -> addData('totalLogs', $totalLogs);

            $logs = $this -> logModel -> getAllLogs();
            $this -> view -> addData('logs', $logs);
            echo $this -> view -> render("logs.php");
        }

        public function createLogView()
        {
            $this -> view -> addData('title', 'Create Logs');
            echo $this -> view -> render("createLog.php");
        }

        public function postLog()  
        {
            $this -> authMiddleWare -> requireLogin();  
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
            $this -> view -> addData('title', 'Log');
            $log = $this -> getFullLog();

            $currentUserId = getAuth('userId'); // Returns null if guest
            
            if ($log['published'] == 0 && $log['owner_id'] !== $currentUserId) {
                setFlash('error', 'This log is private or does not exist.');
                redirect('/explored/explore');
                return;
            }

            $this -> view -> addData('log', $log);

            $logSections = $this -> logSectionModel -> getAllLogSections($_GET['params']['id']);
            $this -> view -> addData('logSections', $logSections);

            $avgCost = $this -> logModel -> getAvgCost($_GET['params']['id']);
            $this -> view -> addData('avgCost', $avgCost);

            $comments = $this -> commentModel -> getAllComments($_GET['params']['id']);
            foreach($comments as &$comment)
            {
                $comment['ownerName'] = $this -> userModel -> getUserName($comment['owner_id']);
            }
            $this -> view -> addData('comments', $comments);

            echo $this -> view -> render("log.php");
        }

        public function publishLog()
        {
            $this -> authMiddleWare -> requireLogin();
            $logId = $_GET['params']['id'];
            $this -> logModel -> publishLog($logId);
            setFlash('success', "Your travel log was published and now all users can see it");
            redirect("/explored/logs/{$logId}");
        }

        public function exploreView()
        {
            $logs = $this -> logModel -> exploreLogs();
            foreach($logs as &$log)
            {
                $log['avgCost'] = $this -> logModel -> getAvgCost($log['id']);
            }
            $this -> view -> addData('title', "Explore");
            $this -> view -> addData('logs', $logs);
            echo $this -> view -> render("explore.php");
        }

    


    }


?>