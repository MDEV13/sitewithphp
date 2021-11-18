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
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
        $user = (new User())::byId($this->conn, $id);
        }
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
    
       include_once './uploads.php';
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //    $photo = filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //    echo $filePath;
       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "") {
           // додати користувача
           $user = new User($name, $email, $gender,$filePath,$password);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

   public function update()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
    //    echo $password;
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $photo = filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $data= [
           'name'=> $name,
           'email'=> $email,
           'gender'=>$gender,
           'photo'=>$photo,
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
}
