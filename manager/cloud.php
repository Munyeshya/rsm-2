<?php 
include '../connection.php';
$order=$_GET['order'];
$query=mysqli_query($conn,"SELECT * FROM orders where orderid ='$order' ");
$fetch=mysqli_fetch_array($query);
$result=$fetch['orderid'];

$query2=mysqli_query($conn,"UPDATE orders set sales='view' where orderid='$order'");
if ($query2) {
	header('location:cashiers.php');
}


?>