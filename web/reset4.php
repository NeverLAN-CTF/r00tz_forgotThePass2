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
    if(array_key_exists('passed', $_GET) &&
       array_key_exists('username', $_GET) &&
       array_key_exists('new_pass', $_GET)){
	if($_GET['passed']=='true'){
	    $Npass = mysqli_real_escape_string($conn, $_GET['new_pass']);
	    $user = mysqli_real_escape_string($conn, $_GET['username']);
	    $query="UPDATE `users` SET `password`='".$Npass."' WHERE `name`='".$user."';";
	    if($data = mysqli_query($conn, $query)){
		echo("<h3>Password has been reset<br><a href='login.php'>Login</a></h3>");
	    }else{
		echo("<h3>Oops, An error occured <br><a href='reset1.php'>Try Again?</a></h3>");
		echo(mysqli_error($conn));
	    }
	}else{
	    echo('<h3>Sorry, looks like you missed a security question</h3><br><a href="reset2.php?username='.$_GET['username'].'">Try Again?</a>');
	}
    }else{
	echo("<h3>You must reset your password <a href='reset1.php'>here</a></h3>");
    }
?>
	
    </body>
</html
