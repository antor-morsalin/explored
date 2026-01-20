<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\LogModel;
    use App\Middlewares\LogMiddleWare;

    class LogController
    {
        private TemplateEngine $view ;
        private Database $db;
        private LogModel $logModel;
        private LogMiddleWare $logMiddleWare;

        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> logModel = new LogModel($conn);
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

        public function logView()
        {
            $this -> view -> addData('title', 'Log');
            $this -> view -> addData('params', $_GET['params']);
            echo $this -> view -> render("log.php");
        }


    }


?>