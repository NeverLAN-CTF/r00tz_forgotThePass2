<!DOCTYPE html>
<html>
    <head>
	<title>Login Page</title>
	<style>
	    body{
		text-align:center;
	    }
	</style>
    </head>
    <body>
<?php
require_once('db.php');

if(array_key_exists('loggout', $_GET)){
    session_unset();
}

$_SESSION['error']='';

if(array_key_exists('username', $_POST) && array_key_exists('password', $_POST) &&
   $_POST['username']!='' && $_POST['password']!=''){
    $name = strtolower(mysqli_real_escape_string($conn, $_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM `users` WHERE `name`='".$name."' AND `password`='".$password."' LIMIT 1;";
    if($data = mysqli_query($conn, $query)){
	if($result = mysqli_fetch_assoc($data)){
	    $_SESSION['id'] = mysqli_real_escape_string($conn, $result['id']);
	    $_SESSION['name'] = mysqli_real_escape_string($conn, $result['name']);
	    $_SESSION['permissions'] = mysqli_real_escape_string($conn, $result['permissions']);
	}else{
	    $_SESSION['error'] = '<p style="text-decoration:bold;">username/password inccorrect</p>';
	    $_SESSION['error'] .= '<a href="reset1.php">Forgot Your password?</a>';
	}
    }else{
	$_SESSION['error'] = "<p style='text-decoration:bold;'>Couldn't connect to database...</p>";
    }
}

if(array_key_exists('id', $_SESSION) && $_SESSION['id']!=''){
    echo('<h3>Hi '.$_SESSION['name'].', you are now logged in</h3>');
    echo('<a href="?loggout">loggout</a><br><br><a href="index.php">Home</a>');
}else{
    echo($_SESSION['error']);
    unset($_SESSION['error']);
    echo('
	<h3>Please, Login</h3>
	<form action="?" method="POST">
	    <label for="username">Username</label>
	    <input name="username" type="text"/>

	    <label for="password">Password</label>
	    <input name="password" type="password"/>
	    
	    <input type="submit"/>
	</form>
    ');
}
?>
    </body>
</html>
