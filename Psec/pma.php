<?php 


include '../connection.php';
$id=$_GET['id'];
$query=mysqli_query($conn,"UPDATE orders set pm='view' where orderid='$id' ");
if ($query) {
	header('location:psec.php');
}else{
	header('location:psec.php');
}
?>