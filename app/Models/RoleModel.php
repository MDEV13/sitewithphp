<?php
class Role {
    // private $id=0;
    private $role;

   public function __construct($role=' ')
   {
        $this->role=$role;
    //    $this->id++;
   }

   public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    } 

   public function add($conn,$id) {
    //    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $sql = "UPDATE users SET id_role='$this->role' WHERE id=$id;";
        //    echo $this->name;
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function all($conn) {
       $sql = "SELECT users.id,users.name,r.title FROM users
       Inner join roles as r on users.id_role=r.id";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }


   public static function update($conn, $id, $data) {
       $sql = "UPDATE users SET id_role='$data' WHERE id=$id;";
       $res = mysqli_query($conn, $sql);
       if ($res) {
        return true;
        }
   }
}