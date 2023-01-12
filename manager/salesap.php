<?php  

include '../connection.php';
$id=$_GET['order'];
$mi=mysqli_query($conn,"UPDATE orders SET pm='view' where orderid='$id' ");
if ($mi) {
	header('location:sales.php');
}else{
	header('location:sales.php');
}

?>