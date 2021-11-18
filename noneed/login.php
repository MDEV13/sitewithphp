<?php
    session_start();
    $isLogIn = false;
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        $isLogIn = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="log">
        <?php if(!$isLogIn): ?>
        <h1>LOGIN</h1>
        <form action="auth.php" method="POST" enctype="multipart/form-data">
            <p>Email</p>
            <input type="email" name="email"><hr>
            <p>Password</p>
            <input type="password" name="password"><hr>
            <input type="submit" value="Login">
        </form>
        <?php else:?>
        <span>
           You have already logged in, you can <a href="logout.php">log out</a> if you want 
        </span>
        <?php endif;?>
    </div>
</body>
</html>