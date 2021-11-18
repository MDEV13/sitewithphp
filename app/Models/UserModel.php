<?php
class User {
    // private $id=0;
    private $name;
    private $email;
    private $gender;
    private $photo;
    private $password;

   public function __construct($name = '', $email = '', $gender = '',$photo='',$password='')
   {
       $this->name = $name;
       $this->email = $email;
       $this->gender = $gender;
       $this->photo = $photo;
       $this->password=$password;
    //    $this->id++;
   }

   public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    } 

    public static function byId($conn,$id)
    {
        $sql = "SELECT * FROM users WHERE id=$id";
        $res = $conn->query($sql);
        if($res->num_rows >0)
        {
            $arr = [];
            $db_row = $res->fetch_assoc();
            return $db_row;
        }
        else{
            return [];
        }
    }

   public function add($conn) {
       $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '$this->password', '$this->photo')";
        //    echo $this->name;
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function all($conn) {
       $sql = "SELECT * FROM users";
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
    $name = $data['name'];
    // echo $data['name'];
    $email = $data['email'];
    $gender = $data['gender'];
    $photo =$data['photo'];
    $password = $data['password'];
    // echo $data['password'];
       $sql = "UPDATE users SET email='$email',name='$name' , gender = '$gender', password= '$password', path_to_img= '$photo' WHERE id=$id;";
       $res = mysqli_query($conn, $sql);
       if ($res) {
        return true;
        }
   }
}
