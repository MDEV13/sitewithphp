<?php 

    function expt()
    {
        require 'uploads.php';
        if(!$_POST["name"] || !$_POST["email"] || !$_POST["gender"])
        {
            throw new Exception('<b style=\'color:red\'> Invalid data');
        }
        
        echo "User Added: ".filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS)." Email: ".filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS)." Gender: ".$_POST['gender'];
            
        if (!file_exists('db/userdata.csv')) 
        {
            file_put_contents('db/userdata.csv', '');
        }
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = $_POST['gender'];
        $fp = fopen('db/userdata.csv', 'a');
        fwrite($fp, "$name,$email,$gender,$filePath\n");
        fclose($fp);
    }
?> 
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       .container {
           width: 400px;
       }
   </style>
</head>
<body style="padding-top: 3rem;">
 
<div class="container">
   <?php     
        try{
            expt();
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
   ?>
   <!-- User Added <?php //if($_POST["name"] && $_POST["email"] && $_POST["gender"]) echo $_POST["name"]; ?><br>
   Email <?php //if($_POST["name"] && $_POST["email"] && $_POST["gender"]) echo $_POST["email"]; ?>
   Gender <?php //if($_POST["name"] && $_POST["email"] && $_POST["gender"]) echo $_POST["gender"]; ?> -->
   <hr>
   <a class="btn" href="adduser.php">return back</a>
   <a class="btn" href="table.php">view list</a>
</div>
</body>
</html>