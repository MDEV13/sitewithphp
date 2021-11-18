
<!doctype html>
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
       <!-- Form to add User -->
       
       <h3>Role of user</h3>
       <form action="?controller=roles&action=add&id=<?=$id?>" method="POST" enctype="multipart/form-data">
           <div class="row">
               <div class="field">
               <label for="role">Choose a role:</label>
               <select width="10px" style="display: inline; width:50%; height: auto; border: 1px solid #c4c4c4;" name="role" id="role">
                   <option value="1" selected>user</option>
                   <option value="2">admin</option>
               </select>
               </div>
           </div>
            <?php if(isset($role)):?> 
                <input type="submit" class="btn" value="Update"></input>
            <?php else:?>
                <input type="submit" class="btn" value="Add"></input>
            <?php endif;?>
       </form>
</div>
</body>
</html>