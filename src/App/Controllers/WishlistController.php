<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use App\Model\{LogModel, WishlistModel, UserModel};
    use App\Middlewares\AuthMiddleware;

    class WishlistController
    {
        private TemplateEngine $view ;
        private Database $db;
        private LogModel $logModel;
        private WishlistModel $wishlistModel;
        private UserModel $userModel;
        private AuthMiddleware $authMiddleware;


        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $this -> db = new Database();
            $conn = $this -> db -> connection();
            $this -> logModel = new LogModel($conn);
            $this -> wishlistModel = new WishlistModel($conn);
            $this -> userModel = new UserModel($conn);
            $this -> authMiddleware = new AuthMiddleware();
        }

        public function wishlistView()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $this->view->addData('title', 'My Wishlist');
            $logIds = $this -> wishlistModel -> getAllLogsId(getAuth('userId'));
            $logs = [];
            foreach($logIds as $val)
            {
                $logs[] = $this -> logModel -> getLog($val['log_id']);
            }
            
            foreach($logs as &$log)
            {
                $log['avgCost'] = $this -> logModel -> getAvgCost($log['id']);
                $log['avgRating'] = round((float) $this -> logModel -> getAvgRating($log['id']));
                $log['ownerName'] = $this -> userModel -> getUserName($log['owner_id']); 
            }
            $this->view->addData('logs', $logs);
            echo $this->view->render("wishlist.php");
        }

        
        public function addToWishlist()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $userId = getAuth('userId');
            $logId = $_GET['params']['id'];

            $onWishlist = $this -> wishlistModel -> onWishList($userId, $logId);
            if($onWishlist)
            {
                setFlash('error', "Can not add duplicate travel_log to the wish list");
                redirect("/explored/logs/{$logId}");
            }

            $this -> wishlistModel -> addToWishlist($userId, $logId);
            setFlash('success', 'Travel log added to the wishlist successfully, go to wishlist to see it');
            redirect("/explored/logs/{$logId}");
        }

        public function removeFromWishlist()
        {
            $this -> authMiddleware -> requireLogin();
            $this -> authMiddleware -> requireUser();
            $userId = getAuth('userId');
            $logId = $_GET['params']['id'];

            $onWishlist = $this -> wishlistModel -> onWishList($userId, $logId);
            if(!$onWishlist)
            {
                setFlash('error', "Can not delete travel_log that is not on the wishlist");
                redirect("/explored/logs/{$logId}");
            }

            $this -> wishlistModel -> removeFromWishlist($userId, $logId);
            setFlash('message', 'Removed from your wishlist');
            redirect("/explored/logs/{$logId}");
        }



    }


?>