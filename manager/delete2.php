<?php 
include '../connection.php';
$id=$_GET['id'];
$sql1=$conn->query("DELETE FROM accounts where id='$id' ") or die(mysqli_error($conn));

if ($sql1) {
 	 header('location:signin.php');
 } 

 ?>