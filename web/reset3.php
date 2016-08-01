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
    <?php
    require_once('db.php');
    if(array_key_exists('passed', $_COOKIE) &&
       array_key_exists('username', $_COOKIE)){
        if($_COOKIE['passed'] == 'true'){
            echo('
                <h3>Pick The New Password</h3>
                <form action="reset4.php" method="GET">
                <label for="new_pass">New Password</label>
                <input name="new_pass" type="text"/>
                <label for="new_pass2">Repeat Password</label>
                <input name="new_pass2" type="text"/>
                <input type="submit"/>
                </form>
            ');
        }else{
            echo("<h3>Sorry, It looks like You missed a security question</h3><br><a href='reset1.php'>Try Again?</a>");
        }
    }
    ?>
    </body>
</html>
