<?php
class UsersController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function delete() {
    include_once 'app/Models/UserModel.php';
    // блок з валідацією
    // echo $_GET['id'];
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if (trim($id) !== "" && is_numeric($id)) {
        (new User())::delete($this->conn, $id);
    }
    header('Location: ?controller=users');
 }
    
    public function show(){
        include_once 'app/Models/UserModel.php';
        include_once 'app/Models/CommentModel.php';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
        $user = (new User())::byId($this->conn, $id);
        }
        $comments = (new CommentModel())::all($this->conn);
        // echo $user['name'];
        include_once 'views/showUser.php';
    }

   public function index()
   {
       include_once 'app/Models/UserModel.php';

       // отримання користувачів
       $users = (new User())::all($this->conn);
       
       include_once 'views/users.php';
   }

   public function addForm(){
       include_once 'views/addUser.php';
   }

   public function add()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
    
       include_once './auth.php';
       $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
       if (trim($email) !== "" && trim($password) !== "") {
           // додати користувача
           $user = new User($first_name,$last_name, $email,$password,$_POST['role']);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

   public function addWA()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
    
       $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
       if (trim($email) !== "" && trim($password) !== "") {
           // додати користувача
           $user = new User($first_name,$last_name, $email,$password,$_POST['role']);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

   public function update()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
    //    echo $password;
       $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       include_once './uploads.php';
    //    $photo = filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password="";
       if(isset($_POST['password'])) $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $data= [
           'fname'=> $fname,
           'lname'=> $lname,
           'email'=> $email,
           'photo'=>$filePath,
           'password'=>$password
       ];
    //    if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($photo) !== "" && trim($password) !== "") {
           // додати користувача
           $user = (new User())::update($this->conn, $_GET['id'],$data);
        //    $user = new User($name, $email, $gender,$photo);
        //    $user->add($this->conn);
    //    }
       header('Location: ?controller=users');
   }

   public function checkUser($email,$pwd)
   {
        include_once 'app/Models/UserModel.php';
        // $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $pwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $arr=(new User())::checkUser($this->conn, $email,$pwd);
        // print_r($arr);
        // header('Location: ?controller=users');
        if(!empty($arr))
        {
            return $arr;      
        }
        else [];
   }

   public function checkEmail($email)
   {
        include_once 'app/Models/UserModel.php';
        // $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $arr=(new User())::checkEmail($this->conn, $email);
        // print_r($arr);
        // header('Location: ?controller=users');
        if(!empty($arr))
        {
            return $arr;      
        }
        else [];
   }

  
}
