<?php
    require_once('db.php');
    if(array_key_exists('username', $_GET) && $_GET['username']!=''){
        $user = mysqli_real_escape_string($conn, strtolower($_GET['username']));
        $query = "SELECT `sq1`, `sq2`, `sa1`, `sa2` FROM `users` WHERE `name`='".$user."' LIMIT 1;";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);
    }else{
        die("<h3><a href='reset1.php'>Please pick a username first</a></h3>");
    }
    
    if(array_key_exists('sa1', $_GET) &&
        array_key_exists('sa2', $_GET) &&
        array_key_exists('username', $_GET) &&
        $_GET['username'] !=''){
        if($_GET['sa1'] == $result['sa1'] && $_GET['sa2'] == $result['sa2']){
            setcookie('username', md5($_GET['username']), time()+3600);
            setcookie('passed', 'true', time()+3600);
            header('Location:reset3.php');
        }else{
            setcookie('username', md5($_GET['username']), time()+3600);
            setcookie('passed', 'false', time()+3600);
            header('Location:reset3.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title>reset your password</title>
    <style>
        body{
            text-align:center;
        }
    </style>
    </head>
    <body>
    <form method="GET" action="?">
        <label for="sa1"><?php echo(($result['sq1']?$result['sq1']:""));?></label>
        <input name="sa1" type="text"/>

        <label for="sa2"><?php echo(($result['sq2']?$result['sq2']:""));?></label>
        <input name="sa2" type="text"/>

        <input type="hidden" name="username" value="<?php echo($_GET['username']);?>"/>
        <input type="submit"/>
    </form>
    </body>
</html>
