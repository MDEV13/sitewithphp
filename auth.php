<?php
session_start();
// echo $_POST['password'];
if(count($_POST)>2)
{
    $_SESSION['user']=$_POST['first_name'];
    echo strlen($_POST["password"]);
    echo strlen($_POST['first_name']);
    echo strlen($_POST['last_name']);
    if($_POST['role']==2) $_SESSION['prior']=true;
    else $_SESSION['prior']=false;
    if(strlen($_POST['first_name'])==0) 
    {
        $_SESSION['auth']=null;
        $_SESSION["pwd"]=false;
        $_SESSION['er_type']='Wrong first name!';
        header('Location: ?controller=index&action=signup');
        exit;
    }
    if(strlen($_POST['last_name'])==0)
    {
        // echo 'sdas';
        $_SESSION['auth']=null;
        $_SESSION["pwd"]=false;
        $_SESSION['er_type']='Wrong last name!';
        header('Location: ?controller=index&action=signup');
        exit;
    }
    if(!empty($_POST['email']))
    {
        
        $_SESSION['er_type']='Email have already used!';
        $_SESSION['auth']=null;
        $_SESSION["pwd"]=false;
        require_once 'config/db.php';
        require_once 'app/Controllers/UsersController.php';
        $db= new DB();
        $check = new UsersController($db);
        $db_row=$check->checkEmail($_POST['email']);
        // print_r($db_row);
        if(!empty($db_row)) 
        {
            header('Location: ?controller=index&action=signup');
            exit;
        }
    }
    if(empty($_POST['email']) || empty($_POST['password']) || $_POST['password']!==$_POST['r_password'] || strlen($_POST["password"])<6)
    {
        $_SESSION['er_type']='Wrong password!';
        $_SESSION['auth']=null;
        $_SESSION["pwd"]=false;
        header('Location: ?controller=index&action=signup');
        exit;
    }
    $_SESSION['pwd1'] = $_POST['password'];
    $_SESSION['email']=$_POST['email'];
    // $_SESSION['hash_pwd'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $_SESSION['auth']=true;
}
else
{
    require_once 'config/db.php';
    require_once 'app/Controllers/UsersController.php';
    // echo 'dfsdfs';
    $db= new DB();
    $check = new UsersController($db);
    $db_row=$check->checkUser($_POST['email'],$_POST['password']);
    // print_r($db_row);
    if(!empty($db_row))
    {
        // echo $db_row['first_name'];
        $_SESSION['user']=$db_row['first_name']; 
        $_SESSION['auth']=true;
        $_SESSION['pwd'] = $_POST['password'];
        // $_SESSION['hash_pwd'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        if($db_row['id_role']==2) $_SESSION['prior']=true;
        else $_SESSION['prior']=false;
    }
    else 
    {
        $_SESSION['signin']=false;
        $_SESSION['er_type']='We have no such user!';
    } 
    $_SESSION['email']=$_POST['email'];
    header('Location: ?controller=users');
} // сделать ошибку при сайн ине...
