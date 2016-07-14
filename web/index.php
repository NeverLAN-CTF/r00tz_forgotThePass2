<!DOCTYPE html>
<html>
    <head>
	<title>Das Blog</title>
	<style>
	    body{
		text-align:center;	
	    }
	    .post{
		border:1px solid black;
		background-color:grey;
		color:white;
	    }
	    .post_title{
		text-decoration:underline;
	    }
	</style>
    </head>
    <body>
	<?php
	    include_once('db.php');
	    $POSTS = [];
	    if(array_key_exists('id',$_SESSION) && $_SESSION['id']!=''){
		$query = "SELECT * FROM `posts` WHERE `permissions`='ADMIN';";
		$data = mysqli_query($conn, $query);
		while($result = mysqli_fetch_assoc($data)){
		    $POSTS[] = "
				<div class='post'>
				    <h3>".$result['title']."</h3>
				    <div style='post_body'>
				    ".$result['content']."
				    </div>
				</div>
		    ";
		}
	    }
	    $query = "SELECT * FROM `posts` WHERE `permissions`='OPEN';";
	    $data = mysqli_query($conn, $query);
	    while($result = mysqli_fetch_assoc($data)){
	        $POSTS[] = "
	    		<div class='post'>
	    		    <h3>".$result['title']."</h3>
	    		    <div style='post_body'>
	    		    ".$result['content']."
	    		    </div>
	    		</div>
	        ";
	    }
   

	    if(array_key_exists("id", $_SESSION) && $_SESSION['id']!=''){
		echo("<h1 class='welcome'>Welcome Admin</h1><hr>");
		echo("<div class='class'>");
	    }else{	
		echo("<h3 class='welcome'>Welcome Visitor</h3>
		    <h6>There is 1 hidden post <a href='login.php'>Login?</a></h6><hr>");
		echo("<div class='body'>");
	    }
	    foreach($POSTS as $key=>$val){
		echo($val .'<hr>');
	    }
	    echo('</div>')
	    
	    
	?>
    </body>
</html>
