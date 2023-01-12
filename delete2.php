<?php 
include 'connection.php';
$id=$_GET['id'];
$sql1=$conn->query("DELETE FROM clients WHERE ID='$id'") or die(mysqli_error($conn));
// $sql2=$conn->query("DELETE FROM export WHERE f_id='$id'") or die(mysqli_error($conn));
// $sql=$conn->query("DELETE FROM furniture WHERE f_id='$id'") or die(mysqli_error($conn));
if ($sql) {
 	echo "deleted";
 } 
 header("location:signin.php");
 ?>