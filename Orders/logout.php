<?php 
require_once('../session_helper.php');
if ($_SESSION['username']) {
	session_destroy();
}
header("location:../index.php");
 ?>