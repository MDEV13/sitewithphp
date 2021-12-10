<?php session_start() ;
    $IIU;
    require_once 'config/db.php';
    // require_once 'Models/CommentModel.php';
    require_once 'app/Controllers/UsersController.php';
    $db= new DB();
    $check = new UsersController($db);
    // print_r($comments);
    $db_row=$check->checkEmail($user['email']);
    if(isset($_SESSION['email'])) $db_row1=$check->checkEmail($_SESSION['email']);
    else $disabled=true;
    // echo $db_row1['path_to_img'];
    // echo date("F j, Y, g:i a");
    // echo $db_row['id'];
    if(isset($_SESSION['prior']) && $_SESSION['prior']===false)
    {
        echo  'q1';
        $IIU=false;
    }
    if($db_row['id']==$user['id'] && isset($_SESSION['pwd']) && password_verify($_SESSION['pwd'],$db_row['pwd'])===true) // другая система для отслежки пароля: пробивка по айди?
    {
        echo  'q3';
        $IIU=true;
    }
    else $IIU=false;
    if(isset($_SESSION['prior']) && $_SESSION['prior']===true)
    { 
        echo  'q2';
        $IIU=true;
    }
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="/public/css/style.css">
   <link rel="stylesheet" href="/assets/css/popup.css">
   <style>
       .container {
           width: 400px;
       }
       hr{
           background-color: grey;
           border-width: 1px;
           margin-top: 25px;
           margin-bottom: 5px;
       }
   </style>
   <!-- <script>
       //window.onload = function ()
       //{
        //    var setImg = document.getElementById('in');

        //    setImg.addEventListener('change', () =>
        //    {
        //         var file = document.getElementById('in').files[0];
        //         console.log(file.name);
        //         document.getElementById('img').src=setImg.value
        //     //  console.log(document.getElementByClassName('in').value);
        //    });  
       }
   </script> -->
</head>

<body>
<header>
       <img class="logo" src="/public/images/Logo_TV_2015.svg" alt="logo" >
       <span>Logo</span>
</header>
<div class="container">
       <!-- Form to Update and Overview style="float: left; position: absolute;" -->
       <h3>Profile of user</h3>
       <form action="?controller=users&action=update&id=<?=$user['id']?>" method="POST" enctype="multipart/form-data">
       <div class="row">
               <div class="file-field " >
                   <div class="file-path-wrapper">
                       <img id='img' width="150px" height="150px" src="<?= isset($user['path_to_img']) && !empty($user['path_to_img']) ? $user['path_to_img'] : "public\images\default.jpg"?>" alt="Error!">
                   </div>
                   <?php if($IIU===true): ?>
                    <div class="btn input-field" style="margin: 20px; margin-left: 10px;">
                       <span>Upload file</span>
                       <input id="in" type="file" name="photo"  accept="image/png, image/gif, image/jpeg, image/jpg"/>
                    </div>
                   <?php endif; ?>
               </div>
        </div>
       <input type="hidden" name="id" value="<?=$user['id']?>" /> 
       <!-- //!isset($_SESSION['prior']) || (isset($_SESSION['prior']) && $_SESSION['prior']===false) -->
            <div class="row">
               <div class="field">
                   <label>Name: <input type="text" <?php if($IIU===false): ?>disabled="disabled"<?php endif; ?> name="fname" value="<?= isset($user['first_name']) ? $user['first_name'] : "" ?>" required></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Name: <input type="text" <?php if($IIU===false): ?>disabled="disabled"<?php endif; ?> name="lname" value="<?= isset($user['last_name']) ? $user['last_name'] : "" ?>" required></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>E-mail: <input type="email" <?php if($IIU===false): ?>disabled="disabled"<?php endif; ?> name="email" value="<?= isset($user['email']) ? $user['email'] : "" ?>" required/><br></label>
               </div>
           </div>
           <?php if($db_row['id']==$user['id'] && isset($_SESSION['pwd']) && password_verify($_SESSION['pwd'],$db_row['pwd'])===true): ?>
           <div class="row">
               <div class="field">
                   <label>Password: <input type="text" name="password" value="<?= isset($_SESSION['pwd']) ? $_SESSION['pwd'] : "" ?>" required/></label>
               </div>
           </div>
           <?php endif; ?>
           <div class="row">
               <div class="field" >
                   <label for="role">Choose a role: </label>
                   <select disabled="disabled" style="display: inline-block; font-size: 11px; width: auto; height: 35px;" name="role" id="role">
                       <option style="font-size: 11px;" <?php if($user['id_role']==2):?>selected<?php endif;?>>Admin</option>
                       <option style="font-size: 11px;" <?php if($user['id_role']==1):?>selected<?php endif;?>>User</option>
                   </select>
               </div>
           </div>
           
           <?php if(isset($_SESSION['prior']) && $_SESSION['prior']===true): ?> 
            <?php if($db_row['id']==$user['id'] && isset($_SESSION['pwd']) && password_verify($_SESSION['pwd'],$db_row['pwd'])===false):?>
                <a href="?controller=users&action=delete&id=<?=$user['id']?>" class="btn">Delete</a> 
            <?php endif; ?> 
            <input type="submit" class="btn" value="Update">
           <!-- // убрать кнопку от самого юзера ну ты понял крч -->
           <?php endif; ?>
           <a href="?controller=users" class="btn">List of Users</a>
       </form>
       
</div>
<hr>
<?php if(isset($_SESSION['auth'])):?>
<form action="?controller=comment&action=add" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_who" value="<?= $db_row1['id']?>">
    <input type="hidden" name="id_whom" value="<?= $user['id']?>">
    <input type="hidden" name="user_name" value="<?=$db_row1['first_name'] ?>"> 
    <input type="hidden" name="date" value="<?= date("F j, Y, g:i a"); ?>">
    <div class="row">
        <div class="field">
        <input type="text" name="comment"> 
        </div>
    </div>
    <input type="submit" class="btn" value="Add comment"></input>
</form>
<?php endif;?>
<div>
    <?php if(isset($comments)):?>
        <?php
           foreach ($comments as $comment):?>
            <?php if($comment['id_whom']===$user['id']):?>
              <tr><td><img width="15px" height="15px" src="<?= isset($comment["img"]) && !empty($comment["img"])? $comment['img'] : "public\images\default.jpg" ?>" alt="error"></img></td>
                  <td><?=$comment['user_name_who']?></td>
                  <form action="?controller=comment&action=update&id=<?=$comment['id_whom'] ?>&date=<?=$comment['dates'] ?>" method='POST' enctype="multipart/form-data">
                  <td><input name="comment" <?php if(isset($db_row1['id']) && $comment['id_who']!=$db_row1['id']  || isset($disabled) && $disabled===true):?> disabled <?php endif; ?>value="<?=$comment['comments']?>"></td>
                  <td><?=$comment['dates']?></td>
                  <td><?php if(isset($db_row1['id']) && $comment['id_who']==$db_row1['id'] || isset($_SESSION['prior']) && $_SESSION['prior']==true):?><a href="?controller=comment&action=delete&id=<?=$comment['id_whom'] ?>&date=<?=$comment['dates']?>">X</a><?php endif;?> </td>
                  <td><?php if(isset($db_row1['id']) && $comment['id_who']==$db_row1['id']):?><input type="submit" style="border:none;background-color:white;cursor:pointer" value="update"></input><?php endif;?></td>
                  </form>     
              </tr><br>
              <?php endif;?> 
           <?php endforeach;?>
    <?php endif;?>    
</div>

</body>
</html>