<?php 
require_once ('session_helper.php');
if (isset($_SESSION['username'] )) {

	unset($_SESSION["username"]);
    unset($_SESSION["password"]);
	session_destroy();
	session_write_close();
	header("location:index.php");
}

 ?>
	
