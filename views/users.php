<?php session_start() ?>
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
   <div class="row">
       <table>
           <?php foreach ($users as $user):?>
              <tr><td><?=$user['name']?></td>
                  <td><?=$user['email']?></td>
                  <td><?=$user['gender']?></td>
                  <td><img width="40px" height="40px" src='<?=!empty($user['path_to_img']) ? $user['path_to_img'] : 'public\images\default.jpg'?>' alt="error!"/></td>
                  <?php if($_SESSION['auth']===false):?>
                  <td><a href="?controller=users&action=delete&id=<?=$user['id']?>">X</a></td>
                  <?php if(!isset($user['id_role'])):?><td><a href="?controller=roles&action=addForm&id=<?=$user['id']?>">role</a></td><?php endif;?>
                  <?php endif;?>
                  <td><a href="?controller=users&action=show&id=<?=$user['id']?>">profile</a></td>
              </tr>
           <?php endforeach;?>
       </table>
   </div>
   <?php if($_SESSION['auth']===false):?>
   <a class="btn" href="?controller=users&action=addForm">Add new user</a>
   <a class="btn" href="?controller=roles">List of role</a>
    <?php endif;?>
   <a class="btn" href="?controller=index">Return back</a>
   
</div>
</body>
</html>
