<?php
    class CommentModel
    {
        private $comments;
        private $id_who;
        private $id_whom;
        private $img;
        private $dates;
        // private $id_addresses;
        
        public function __construct($img='',$user_name_who='',$comments = '',$dates='',$id_who=0, $id_whom = 0)
        {
            $this->comments = $comments;
            $this->img = $img;
            $this->user_name_who =  $user_name_who;
            $this->dates =  $dates;
            $this->id_who =  $id_who;
            $this->id_whom =  $id_whom;
        }

        public static function all($conn)
        {
             $sql = "SELECT * FROM comments";
             $res=$conn->query($sql);
             if($res->num_rows>0)
             {
                $arr = [];
                while ( $db_field = $res->fetch_assoc() ) {
                $arr[] = $db_field;    
                }
                return $arr;  
             }
             else return [];
        }
     
        public function addComment($conn)
        {
            $photo=(new User)::byId((new Db())->getConnect(),$this->id_who);
            $photom=$photo['path_to_img'];
            $sql = "INSERT INTO comments (img,user_name_who,comments,dates,id_who,id_whom) 
            VALUES ('$photom','$this->user_name_who','$this->comments','$this->dates',$this->id_who,$this->id_whom);";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                return true;
            }
        }

        public static function delete($conn, $id, $dates) {
            $sql = "DELETE FROM comments WHERE id_whom=$id and dates='$dates'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                return true;
            }
        }

        public static function update($conn, $id, $dates, $data) {
            $sql='';
            if(!empty($data))
            {
                $sql = "UPDATE comments SET comments='$data' WHERE id_whom=$id and dates='$dates';";
            }  
               $res = mysqli_query($conn, $sql);
               if ($res) {
                return true;
                }
            }
    }