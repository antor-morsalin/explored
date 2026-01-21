<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogModel, LogSectionModel, UserModel};
    use App\Middlewares\LogMiddleWare;

    class LogController
    {
        private TemplateEngine $view ;
        private Database $db;
        private UserModel $userModel;
        private LogModel $logModel;
        private LogSectionModel $logSectionModel;
        private LogMiddleWare $logMiddleWare;

        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> userModel = new UserModel($conn);
            $this -> logModel = new LogModel($conn);
            $this -> logSectionModel = new LogSectionModel($conn);
            $this -> logMiddleWare = new LogMiddleWare();
        }

        public function logsView()
        {
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
            $ownerName = $this -> userModel -> getUserName($log['owner_id']);
            $log['ownerName'] = $ownerName;
            return $log;
        }

        public function logView()
        {
            $this -> view -> addData('title', 'Log');
            $log = $this -> getFullLog();
            $this -> view -> addData('log', $log);

            $logSections = $this -> logSectionModel -> getAllLogSections($_GET['params']['id']);
            $this -> view -> addData('logSections', $logSections);
            echo $this -> view -> render("log.php");
        }

    


    }


?>