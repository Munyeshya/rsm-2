<?php  

include '../connection.php';
$id=$_GET['id'];

$query=$conn->query("UPDATE orders set factory='view' where orderid='$id' ") or die(mysql_error($conn)) ;
header('location:files.php');

?>