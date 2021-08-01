<?php 

session_start();

if (isset($_SESSION['name'])) {
    header("location:login.php");
	session_destroy();
	
	
}

else{
	header("location:login.php");
}

 ?>