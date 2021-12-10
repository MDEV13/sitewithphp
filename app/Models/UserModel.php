<?php
class User {
    // private $id=0;
    private $first_name;
    private $last_name;
    private $email;
    private $pwd;
    private $id_role;

   public function __construct($first_name = '',$last_name='', $email = '', $pwd = '',$id_role='')
   {
       $this->first_name = $first_name;
       $this->last_name = $last_name;
       $this->email = $email;
       $this->pwd = $pwd;
       $this->id_role=$id_role;
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
       $sql = "INSERT INTO users (first_name, last_name,email, pwd,path_to_img,id_role) 
           VALUES ('$this->first_name','$this->last_name','$this->email','$this->pwd','',$this->id_role);";
        //    echo $this->name;  
           $res = mysqli_query($conn, $sql);
        //    echo 'sdds';
           if ($res) {
            // echo '1232sdds';
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

   public static function checkUser($conn,$email,$pwd)
   {
       $sql = "SELECT first_name,email,pwd,id_role FROM users";
       $res=$conn->query($sql);
       if($res->num_rows>0)
       {
            while ( $db_field = $res->fetch_assoc() ) {
                if($db_field['email']==$email && password_verify($pwd,$db_field['pwd'])===true) 
                {
                    return $db_field;
                }
                
            }
       }
       return [];
   }

   public static function checkEmail($conn,$email)
   {
       $sql = "SELECT id,path_to_img,first_name,last_name,email,pwd,id_role FROM users";
       $res=$conn->query($sql);
       if($res->num_rows>0)
       {
            while ( $db_field = $res->fetch_assoc() ) {
                if($db_field['email']==$email) 
                {
                    return $db_field;
                }
                
            }
       }
       return [];
   }


   public static function update($conn, $id, $data) {
    $fname = $data['fname'];
    $lname = $data['lname'];
    $email = $data['email'];
    $photo =$data['photo'];
    $password = $data['password'];
    
    // echo $data['password'];
    $sql='';
    if(empty($password) && strlen($password)<6)
    {
        $sql = "UPDATE users SET email='$email',first_name='$fname',last_name='$lname', path_to_img= '$photo' WHERE id=$id;";
    }
    else{
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email='$email',first_name='$fname',last_name='$lname', pwd= '$password', path_to_img= '$photo' WHERE id=$id;";
    }   
       $res = mysqli_query($conn, $sql);
       if ($res) {
        return true;
        }
    }

}
