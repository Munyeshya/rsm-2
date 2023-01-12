<?php 

include '../connection.php';
$id=$_GET['order'];
$query1=$conn->query("UPDATE orders set file='view' where orderid='$id' ")or die(mysqli_error($conn)) ;
header('location:pm.php');

?>