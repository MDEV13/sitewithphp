<?php session_start();
        // $isLogIn = false;
        // if (isset($_SESSION['auth'])) {
        //     $isLogIn = true;
        // }
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
       header
       {
            display: flex;
            align-items: center;
            width: 100%;
            height: 50px;
            background-color: rgb(255, 255, 128);
       }
       .logo{
            width: 45px;  
            height: 45px;
            margin-left: 10px;
            margin-right: 10px;
       }
       span
       {
            font: italic small-caps bold 12px/1 sans-serif;;
       }
       .reg{
            align-items: flex-end;
            margin-left: 75%;
       }
   </style>
</head>
<body>
<header>
       <img class="logo" src="/public/images/Logo_TV_2015.svg" alt="logo" >
       <span>Logo</span>
       <!-- <span class="reg"><a href="?controller=index&action=signin">Sign in</a></span> -->
       <!-- <span style="margin-left:20px">Sign up</span> -->
</header>
<div class="container" style="padding-top: 3rem;">
       <h3>Sign Up</h3>
       <form action="?controller=users&action=add" method="post" enctyped="multipart/form-data">
       <div class="row">
               <div class="field">
                   <label>First name: <input type="text" name="first_name"></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Last name: <input type="text" name="last_name"></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Email: <input type="email" name="email" required></label>
               </div>
           </div>
           <div class="row">
               <div class="field" >
                   <label for="role">Choose a role: </label>
                   <select style="display: inline-block; font-size: 11px; width: auto; height: 35px;" name="role" id="role">
                       <option style="font-size: 11px;" value='2'>Admin</option>
                       <option style="font-size: 11px;" value='1'>User</option>
                   </select>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Password: <input type="password" name="password"><br></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Repeat password: <input type="password" name="r_password"><br></label>
               </div>
           </div>
            <?php if(isset($_SESSION['pwd']) && $_SESSION['pwd']==false):?>
            <div style="color: red; padding-bottom: 5px;">
                <?php echo $_SESSION['er_type']; ?>
            </div>
            <?php endif;?>
           <input style="margin-bottom: 30px;" type="submit" class="btn" value="Sign up">
       </form>

        <!-- <span>
           You have already logged in, you can <a href="../logout.php">log out</a> if you want 
        </span> -->

</div>
</body>
</html>
