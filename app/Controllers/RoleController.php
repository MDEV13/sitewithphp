<?php
class RoleController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function delete() {
    include_once 'app/Models/RoleModel.php';
    // блок з валідацією
    // echo $_GET['id'];
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if (trim($id) !== "" && is_numeric($id)) {
        (new Role())::delete($this->conn, $id);
    }
    header('Location: ?controller=roles');
 }
    
    // public function show(){
    //     include_once 'app/Models/RoleModel.php';
    //     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     if (trim($id) !== "" && is_numeric($id)) {
    //     $user = (new Role())::byId($this->conn, $id);
    //     }
    //     // echo $user['name'];
    //     include_once 'views/showUser.php';
    // }

   public function index()
   {
       include_once 'app/Models/RoleModel.php';

       // отримання користувачів
       $users = (new Role())::all($this->conn);
       include_once 'views/roles.php';
   }

   public function addForm(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       include_once 'views/controlRole.php';
   }

   public function add()
   {
       include_once 'app/Models/RoleModel.php';
       $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       echo $role;
       if(trim($role) !== "") {
           // додати користувача
           $user = new Role($role);
           $user->add($this->conn,$id);
       }
       header('Location: ?controller=roles');
   }

   public function update()
   {
       include_once 'app/Models/RoleModel.php';
    //    if($_POST['role']==='admin') $role=2;
    //    else $role=1;
       if (trim($role) !== "") {
           // додати користувача
           $user = (new Role())::update($this->conn, $_GET['id'],$role);
        }
       header('Location: ?controller=roles');
   }
}
