<?php
    declare(strict_types=1);

    function dd(mixed $val)
    {
        echo "<pre>";
        var_dump($val) ;
        echo "</pre>";

        die();
    }

    function e(mixed $value) : string
    {
        return htmlspecialchars((string) $value);
    }

    function redirect(string $location)
    {
        header("Location: {$location}");
        http_response_code(302);
        exit;
    }

    function flash(string $key) : string
    {
        if(isset($_SESSION['flash'][$key]))
        {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return '';
    }

    function setFlash(string $key, string $value)
    {
        $_SESSION['flash'][$key] = $value;
    }

    function setAuth(string $key, string $value)
    {
        $_SESSION['auth'][$key] = $value;
    }

    function isLoggedIn() : bool
    {
        if(isset($_SESSION['auth']['user']))
        {
            return true;
        }
        return false ;
    }

    function logout()
    {
        session_unset();
        redirect("/explored/login");
    }
    
?>