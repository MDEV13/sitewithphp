<?php
class IndexController
{
    private $conn;

   public function __construct($db)
   {
       $this->conn=$db->getConnect();
   }

   public function index()
   {
       // виклик відображення
       include_once 'views/home.php';
        // header("Location: views/home.php");
   }

   public function auth()
   {
       // виклик відображення
       include_once 'auth.php';
        // header("Location: views/home.php");
   }

   public function logout()
   {
       // виклик відображення
       include_once 'logout.php';
        // header("Location: views/home.php");
   }

   public function signup()
   {
       // виклик відображення
       include_once 'views/SignUp.php';
        // header("Location: views/home.php");
   }
}
