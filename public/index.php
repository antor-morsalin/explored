<?php
    // View folder er shob design apadoot mockup, oita akdom e final design na, just 
    // backend kaj kore kina sheta dekhar jonne oi template use kora. shob abar 
    // design korte hobe
    declare(strict_types=1);
    session_start();

    include __DIR__."/../src/App/functions.php";
    require __DIR__ . "/../vendor/autoload.php";

    use Framework\App;
    use App\Controllers\{HomeController, AuthController};
    use App\Model\Database;

    $app = new App();

    // Registering routes
    $app -> get('/explored', [HomeController::class, 'home']);

    $app -> get('/explored/register', [AuthController::class, 'registerView']);
    $app -> post('/explored/register', [AuthController::class, 'register']);

    $app -> get('/explored/login', [AuthController::class, 'loginView']);
    $app -> post('/explored/login', [AuthController::class, 'login']);
    

    $app->run();


    //($app);


?>