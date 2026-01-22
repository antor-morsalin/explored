<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogSectionModel, LogModel, UserModel};
    use App\Middlewares\{AuthMiddleWare, LogMiddleWare};


    class LogSectionController
    {
        private TemplateEngine $view ;
        private Database $db;
        private LogSectionModel $logSectionModel;
        private LogModel $logModel;
        private UserModel $userModel;
        private AuthMiddleWare $authMiddleWare;


        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> logSectionModel = new LogSectionModel($conn);
            $this -> logModel = new LogModel($conn);
            $this -> authMiddleWare = new AuthMiddleWare();
        }

        
        public function newSectionView()
        {
            $this -> authMiddleWare -> requireLogin();

            $logId = $_GET['params']['id'];
            $log = $this->logModel->getLog($logId);
            $userId = getAuth('userId');

            if ($log['owner_id'] !== $userId) 
            {
                setFlash('error', 'You cannot add sections to someone else\'s log.');
                redirect("/explored/logs/{$logId}");
                return;
            }

            $this -> view -> addData('title', 'New Section');
            $logId = $_GET['params']['id'];
            $this -> view -> addData('logId', $logId);
            echo $this -> view -> render("newLogSection.php");
        }

        public function postNewSection()
        {
            $this -> authMiddleWare -> requireLogin();
            $this -> authMiddleWare -> requireUser();
            $ownerId   = getAuth('userId');
            $logId     = $_GET['params']['id'];

            $log = $this->logModel->getLog($logId);
            if ($log['owner_id'] !== $ownerId) 
            {
                setFlash('error', 'You cannot add sections to someone else\'s log.');
                redirect("/explored/logs/{$logId}");
                return;
            }

            $placeName = trim($_POST['place_name']);
            $placeType = trim($_POST['place_type']);
            $mapLink   = trim($_POST['map_link']);
            $avgCost   = trim($_POST['avg_cost']);
            $rating    = trim($_POST['rating']);

            $this->logSectionModel->saveLogSection($ownerId, $logId, $placeName, $placeType, $mapLink, 
            $avgCost, $rating);

            setFlash('success', 'New section added to your travel log successfully');
            redirect("/explored/logs/{$logId}");
        }



    }


?>