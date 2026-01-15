<?php
    declare(strict_types=1);
    session_start();

    include __DIR__."/../src/App/functions.php";
    require __DIR__ . "/../vendor/autoload.php";

    use Framework\App;
    use App\Controllers\{HomeController, AuthController};

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

    $app->run();
?>