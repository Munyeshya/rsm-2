<?php 
include '../connection.php';
$orderid=$_GET['orderid'];
$query=mysqli_query($conn,"SELECT * FROM orders where orderid ='$orderid' ");
$fetch=mysqli_fetch_array($query);
$result=$fetch['orderid'];

$query2=mysqli_query($conn,"UPDATE orders set sales='view' where orderid='$orderid' ");
if ($query2) {
	header('location:cashiers.php');
}


?>