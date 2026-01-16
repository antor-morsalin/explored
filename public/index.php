<?php
    declare(strict_types=1);
    session_start();

    include __DIR__."/../src/App/functions.php";
    require __DIR__ . "/../vendor/autoload.php";

    use Framework\App;
    use App\Controllers\{HomeController, AuthController, AdminController, ProfileController};

    $app = new App();

    // Registering routes
    $app -> get('/explored', [HomeController::class, 'home']);

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


    $app -> get('/explored/admin/dashboard', [AdminController::class, 'dashboard']);
    $app -> get('/explored/admin/messages', [AdminController::class, 'messages']);

    $app -> get('/explored/admin/users', [AdminController::class, 'users']);
    $app -> post('/explored/admin/users', [AdminController::class, 'deleteUser']);

    $app -> get('/explored/logout', [AuthController::class, 'logout']);
    
    
    $app -> get('/explored/profile', [ProfileController::class, 'index']);
    $app -> get('/explored/profile/logs', [ProfileController::class, 'logs']);
    $app -> get('/explored/profile/wishlist', [ProfileController::class, 'wishlist']);
    $app -> get('/explored/profile/settings', [ProfileController::class, 'settings']);
    $app -> post('/explored/profile/password', [ProfileController::class, 'updatePassword']);
    $app->run();
?>