<?php

    namespace App\Middlewares;
    use App\Model\LogModel;
    class LogMiddleWare
    {
        public function validateLogData()
        {
            if (empty(trim($_POST['title'] ?? '')) || empty(trim($_POST['description'] ?? '')) || empty(trim($_POST['journey_type'] ?? ''))) 
            {
                flash('error', 'Invalid data inserted');
                redirect("/explored/logs/createlog");
            }
        }
        
    }

?>