<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="/assets/css/popup.css">
   <link rel="stylesheet" href="/public/css/style.css">
   <style>
       .container {
           width: 400px;
       }
       
       .reg{
            align-items: flex-end;
            margin-left: 75%;
       }
   </style>
   <script>
       
       window.onload= function() {  

            var si =document.getElementById("signin");

            si.addEventListener('click',()=>{
                
                var win =document.getElementById("pop");
                // console.log(win);
                win.style.display="block";
            });
            var btn =document.getElementById("btn");

            btn.addEventListener('click',()=>{
                
                var win =document.getElementById("pop");
                // console.log(win);
                win.style.display="none";
            });

            <?php if(isset($_SESSION['signin']) && $_SESSION['signin']===false):?>
                var win =document.getElementById("pop");
                win.style.display="block";
            <?php endif;?> 
       }
   </script>
</head>
<body>
<header>
       <img class="logo" src="/public/images/Logo_TV_2015.svg" alt="logo" >
       <span>Logo</span>
       <?php if(!isset($_SESSION['user'])):?>
       <span class="reg" id="signin" style="cursor: pointer;">Sign in</span>
       <span style="margin-left:20px" ><a href="?controller=index&action=signup" style="color: black;">Sign up</a></span>
       <?php else:?>
        <span class="reg" ><?php echo $_SESSION['user']?></span>
       <span style="margin-left:20px" ><a href="?controller=index&action=logout" style="color: black;">Sign out</a></span>
       <?php endif;?>
</header>
<div class="container" style="padding-top: 3rem;">
    <div style="margin-bottom:20px">
    <form action="?controller=users" method="POST" enctype="multipart/form-data">
        <input type="text" name="search" style="width:75%;height:20px" placeholder="Search"></input>
        <input type='submit' value="Search">
    </form>
    </div>
   <div class="row">
       <table>
       <tr>
            <td>#</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Email</td>
            <td>Role</td>
        </tr>
        <?php if(isset($users)):?>
           <?php $count=1; 
           foreach ($users as $user):?>
            <?php if(isset($_POST['search']) && !empty($_POST['search']) ):?>
                <?php $search = filter_input(INPUT_POST,'search',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $search=trim($search);  
                $str=explode(" ",$search);
                if(strcmp($user['first_name'],$str[0])==0 && strcmp($user['last_name'],$str[1])==0):?>
                <tr><td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?php echo $count;?></a></td>
                  <td><?=$user['first_name']?></td>
                  <td><?=$user['last_name']?></td>
                  <td><?=$user['email']?></td>
                  <td><?php if($user['id_role']==1) :?>User<?php else:?>Admin<?php endif;?></td>
                </tr>
                <?php endif;?>
            <?php else:?>
              <tr><td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?php echo $count;?></a></td>
                  <td><?=$user['first_name']?></td>
                  <td><?=$user['last_name']?></td>
                  <td><?=$user['email']?></td>
                  <td><?php if($user['id_role']==1) :?>User<?php else:?>Admin<?php endif;?></td>
              </tr>
            <?php endif;?>
           <?php $count++; endforeach;?>
        <?php endif;?>
       </table>
   </div>
   <?php if(isset($_SESSION['auth']) && $_SESSION['auth']===true && isset($_SESSION['prior']) && $_SESSION['prior']==true):?>
   <a class="btn" href="?controller=users&action=addForm">Add new user</a>
    <?php endif;?>
   <!-- <a class="btn" href="?controller=index">Return back</a> -->
</div>
<div class="pop_up" id="pop">
    <div class="pop_up_body">
        <div class="content">
        <span id="btn">
            X
        </span>
        <!-- <h3>Sign in</h3> -->
        <form action="?controller=index&action=auth" method="POST" enctype="multipart/form-data">
            <div class="row">                                                                                                                                                                                              
                <div class="field">
                    <label>Email: <input type="email" name="email"></label>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <label>Password: <input type="password" name="password"><br></label>
                </div>
            </div>
            <?php if(isset($_SESSION['signin']) && $_SESSION['signin']==false):?>
                <p style="color:red"><?php echo $_SESSION['er_type']; $_SESSION['signin']=null;?></p>
            <?php endif; ?>
            <input type="submit" class="btn" value="Sign in">
        </form>
        </div>
    </div>     
</div>
</body>
</html>
