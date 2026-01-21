<?php
    declare(strict_types=1);
    session_start();

    include __DIR__."/../src/App/functions.php";
    require __DIR__ . "/../vendor/autoload.php";

    use Framework\App;
    use App\Controllers\{HomeController, AuthController, AdminController, LogController, ProfileController, LogSectionController, CommentController};

    $app = new App();

    // --- HOME & AUTH ROUTES ---
    $app -> get('/explored', [HomeController::class, 'homeView']);

    $app -> get('/explored/register', [AuthController::class, 'registerView']);
    $app -> post('/explored/register', [AuthController::class, 'register']);

    $app -> get('/explored/login', [AuthController::class, 'loginView']);
    $app -> post('/explored/login', [AuthController::class, 'login']);
    
    $app -> get('/explored/about', [HomeController::class, 'aboutView']);
    $app -> get('/explored/contact', [HomeController::class, 'contactView']);
    $app -> post('/explored/contact', [HomeController::class, 'storeContactMessage']);
    $app -> get('explored/privacy-policy', [AuthController::class, 'privacyPolicyView']);
    $app -> get('/explored/terms-and-conditions', [AuthController::class, 'termsAndConditionsView']);

    $app -> get('/explored/api/check-username', [AuthController::class, 'checkUsername']);

    // --- ADMIN ROUTES ---
    $app -> get('/explored/admin/dashboard', [AdminController::class, 'dashboardView']);
    $app -> get('/explored/admin/messages', [AdminController::class, 'messagesView']);
    $app -> get('/explored/admin/users', [AdminController::class, 'usersView']);
    
    $app -> post('/explored/admin/users', [AdminController::class, 'deleteUser']);

    $app -> get('/explored/logout', [AuthController::class, 'logout']);
    
    // --- PROFILE ROUTES ---
    $app -> get('/explored/profile', [ProfileController::class, 'indexView']);
    $app -> get('/explored/profile/wishlist', [ProfileController::class, 'wishlistView']);
    $app -> get('/explored/profile/settings', [ProfileController::class, 'settingsView']);
    $app -> post('/explored/profile/password', [ProfileController::class, 'updatePassword']);

    // --- LOG ROUTES ---
    $app -> get('/explored/logs', [LogController::class, 'logsView']);
    $app -> get('/explored/createlog', [LogController::class, 'createLogView']);
    $app -> post('/explored/logs', [LogController::class, 'postLog']);
    $app -> get('/explored/logs/:id', [LogController::class, 'logView']);
    $app -> post('/explored/logs/:id/publish', [LogController::class, 'publishLog']);
    


    // Log Section Routes
    $app -> get('/explored/logs/:id/new', [LogSectionController::class, 'newSectionView']);
    $app -> post('/explored/logs/:id/new', [LogSectionController::class, 'postNewSection']);




    // explore
    $app -> get('/explored/explore', [LogController::class, 'exploreView']);



    //Comments
    $app -> post('/explored/comment/:id', [CommentController::class, 'postComment']);




    
    $app->run();
?>