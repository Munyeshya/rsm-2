<?php
include '../connection.php';
$id=$_GET['id'];

$quer1=mysqli_query($conn,"DELETE FROM pending where orderid='$id'  ");
if ($quer1) {
	header('location:viewpeding.php').$conn->error;
}
?>