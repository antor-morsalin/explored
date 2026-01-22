<?php 

    declare(strict_types=1);

    namespace App\Controllers;

    use Framework\TemplateEngine;
    use App\Model\Database;
    use mysqli;
    class HomeController
    {
        private TemplateEngine $view ;
        private mysqli $conn;
        public function __construct()
        {
            $this -> view = new TemplateEngine(__DIR__."/../views");
            $db = new Database();
            $this->conn = $db->connection();
        }

        public function homeView()
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

        public function storeContactMessage()
        {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $stmt = $this->conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            $stmt->execute();
            $stmt->close();

            // $_SESSION['flash'] = ['success' => "Message sent! We'll get back to you soon."];
            setFlash('success', "Message sent! We'll get back to you soon.");
            redirect("/explored/contact");  
            exit;
        }
    }


?>