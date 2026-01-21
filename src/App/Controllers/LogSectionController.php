<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogSectionModel, UserModel};


    class LogSectionController
    {
        private TemplateEngine $view ;
        private Database $db;
        private LogSectionModel $logSectionModel;


        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> logSectionModel = new LogSectionModel($conn);
        }

        
        public function newSectionView()
        {
            $this -> view -> addData('title', 'New Section');
            $logId = $_GET['params']['id'];
            $this -> view -> addData('logId', $logId);
            echo $this -> view -> render("newLogSection.php");
        }

        public function postNewSection()
        {
            $ownerId   = getAuth('userId');
            $logId     = $_GET['params']['id'];
            $placeName = trim($_POST['place_name']);
            $placeType = trim($_POST['place_type']);
            $mapLink   = trim($_POST['map_link']);
            $avgCost   = trim($_POST['avg_cost']);
            $rating    = trim($_POST['rating']);

            $this->logSectionModel->saveLogSection(
                $ownerId,
                $logId,
                $placeName,
                $placeType,
                $mapLink,
                $avgCost,
                $rating
            );

            setFlash('success', 'New section added to your travel log successfully');
            redirect("/explored/logs/{$logId}");
        }



    }


?>