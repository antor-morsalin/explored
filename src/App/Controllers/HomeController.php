<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;

    class HomeController
    {
        private TemplateEngine $view ;

        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
        }

        public function home()
        {
            // I wonder ekhane middleware gula boshabo naki
            $this -> view -> addData('title', 'Home Page');
            echo $this -> view -> render("index.php");
        }

        public function contactView()
        {
            $this -> view -> addData('title', 'Contact Us');
            echo $this -> view -> render("contact.php");
        }

        public function aboutView()
        {
            $this->view->addData('title', 'About Us');
            echo $this->view->render("about.php");
        }
    }


?>