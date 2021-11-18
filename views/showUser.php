<?php session_start() ?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       body{
           padding-top: 3rem;
       }
       .container {
           width: 400px;
       }
   </style>
</head>
<body>
<div class="container">
       <!-- Form to Update and Overview -->
       <h3>Profile of user</h3>
       <form action="?controller=users&action=update&id=<?=$user['id']?>" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="id" value="<?=$user['id']?>" />
            <div class="row">
               <div class="field">
                   <label>Name: <input type="text" <?php if($_SESSION['auth']===true): ?>disabled="disabled"<?php endif; ?> name="name" value="<?= isset($user['name']) ? $user['name'] : "" ?>" ></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>E-mail: <input type="email" <?php if($_SESSION['auth']===true): ?>disabled="disabled"<?php endif; ?> name="email" value="<?= isset($user['email']) ? $user['email'] : "" ?>" /><br></label>
               </div>
           </div>
           <?php if($_SESSION['auth']===false): ?>
           <div class="row">
               <div class="field">
                   <label>Password: <input type="text" name="password" value="<?= isset($user['password']) ? $user['password'] : "" ?>"/></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Role: <input type="text" name="password" disabled="disabled" value="<?= isset($user['id_role']) ? ($user['id_role']==='1' ? 'user' : 'admin') : "" ?>"/></label>
               </div>
            </div>
           <?php endif; ?>
           <div class="row">
               <div class="field">
                   <label>
                       <input class="with-gap" <?php if($_SESSION['auth']===true): ?>disabled="disabled"<?php endif; ?> type="radio" name="gender" <?php if (isset($user['email']) && $user['gender']=='female'):?>checked<?php endif;?> value="female"/>
                       <span>Female</span>
                   </label>
               </div>
               <div class="field">
                   <label>
                       <input class="with-gap" <?php if($_SESSION['auth']===true): ?>disabled="disabled"<?php endif; ?>  type="radio" name="gender" <?php if (isset($user['email']) && $user['gender']=='male'):?>checked<?php endif;?> value="male" />
                       <span>Male</span>
                   </label>
               </div>
           </div>
           <div class="row" >
               <div class="file-field input-field">
                   <div class="btn">
                       <span>Photo</span>
                       <input type="file" <?php if($_SESSION['auth']===true): ?>disabled="disabled"<?php endif; ?> name="photo"  accept="image/png, image/gif, image/jpeg" value="<?php isset($user['photo']) ? $user['photo'] : "" ?>"/>
                   </div>
                   <div class="file-path-wrapper">
                       <img width="150px" height="150px" src="<?= isset($user['photo']) ? $user['photo'] : "public\images\default.jpg"?>" alt="Error!">
                   </div>
               </div>
           </div>
           <?php if($_SESSION['auth']===false): ?>
           <input type="submit" class="btn" value="Update">
           <?php endif; ?>
           <a href="?controller=users" class="btn">List of Users</a>
       </form>
</div>
</body>
</html>