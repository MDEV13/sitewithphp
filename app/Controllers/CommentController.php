<?php
    class CommentController
    {
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db->getConnect();
        }

        // public function index()
        // {
        //     include_once 'app/Models/UserModel.php';

        //     // отримання користувачів
        //     $users = (new CommentModel())::all($this->conn);
        //     include_once 'views/showUser.php';
        // }
        public function update()
        {
            include_once 'app/Models/CommentModel.php';
            // блок з валідацією
        //    echo $password;
            // $comment = filter_input(INPUT_GET, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data= filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // echo $data;
            // echo $date;
            // echo $id;
            // додати користувача
            if(!empty($data)) $user = (new CommentModel())::update($this->conn, $id,$date,$data);
            //    $user = new User($name, $email, $gender,$photo);
            //    $user->add($this->conn);
        //    }
            header('Location: ?controller=users&action=show&id='.$id);
        }

        public function add()
        {
            include_once 'app/Models/CommentModel.php';
            include_once 'app/Models/UserModel.php';
            // блок з валідацією
                if(empty($_POST['comment'])) 
                {
                    header('Location: ?controller=users&action=show&id='.$_POST['id_whom']);
                    exit;
                }
                echo $_POST['img'];
                echo $_POST['user_name'];
                echo $_POST['comment'];
                echo $_POST['id_who'];
                echo $_POST['id_whom'];
                $img = filter_input(INPUT_POST,'img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user_name = filter_input(INPUT_POST,'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $comment = filter_input(INPUT_POST,'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // include_once './uploads.php';
                // $= filter_input(INPUT_POST,'img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $user = new CommentModel($img,$user_name, $comment,$_POST['date'],$_POST['id_who'],$_POST['id_whom']);
                $user->addComment($this->conn);
            // }
            header('Location: ?controller=users&action=show&id='.$_POST['id_whom']);
        }

        public function delete() {
            include_once 'app/Models/CommentModel.php';
            // блок з валідацією
            // echo $_GET['id'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dates= filter_input(INPUT_GET, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo $id;
            echo $dates;
            if (trim($id) !== "" && is_numeric($id)) {
                // echo 'dasd';
                (new CommentModel())::delete($this->conn, $id,$dates);
            }
            header('Location: ?controller=users&action=show&id='.$id);
         }
    }
?>