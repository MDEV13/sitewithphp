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
            if (file_exists('db/userdata.csv')) 
            {
                $users=[];
                // =array();
                $str=file_get_contents('db/userdata.csv');
                $str=explode("\n",$str);
                // echo $str[0];
                foreach($str as $i)
                {
                    if (empty($i)) continue;
                    // echo $i;
                    $i=explode(',',$i);
                    // echo var_dump($i);
                    $users[] = [
                            'name' => $i[0],
                            'email' => $i[1],
                            'gender' => $i[2],
                            'photo' => $i[3]
                        ];
                }
                
                for($i=0;$i<count($users);$i++)
                {
                    echo "<p style='word-spacing: 25px'>".$users[$i]['name']." ".$users[$i]['email']." ".$users[$i]['gender']."<img style='margin-left: 20px' width='40px' height='40px' src=\"".$users[$i]['photo']."\" alt=\"Error\"'></p><hr>";
                }
            }
            if(empty(file_get_contents('db/userdata.csv')))
            {
                echo "We have nothing in the file!<hr>";
            }
            ?>
        <a class="btn" href="adduser.php">return back</a>
    </div>
</body>
</html>
