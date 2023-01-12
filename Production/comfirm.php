<?php  
include '../connection.php';
$id=$_GET['id'];
$query=mysqli_query($conn,"UPDATE orders set done='yes'  where orderid='$id'  ");
if ($query) {
	header('location:psec.php');
}else{
	header('location:factory.php');
}


?>