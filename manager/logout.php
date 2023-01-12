<?php 
require_once('../session_helper.php');
if ($_SESSION['login']) {
	session_destroy();
}
header("location:../index.php");
 ?>