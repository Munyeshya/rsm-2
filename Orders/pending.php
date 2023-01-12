<?php

require_once('../session_helper.php');
if ($_SESSION['username'] and $_SESSION['ccid']) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];
$idi=$_SESSION['ccid'];
include '../connection.php';
$id=$_GET['orderid'];
$query=mysqli_query($conn,"SELECT * FROM orders where orderid ='$id' ");
$fetch=mysqli_fetch_array($query);


$haha=mysqli_query($conn,"SELECT orderid from pending where operator='$name'");
$hah=mysqli_fetch_array($haha);
@$ha=$hah['orderid'];

if (!empty($ha)) {
	header("location:ordering.php?id=$idi");

}elseif( empty($ha) ){

	$query2=$conn->query(
	"INSERT into pending(id,orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n)
     SELECT id,orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n from orders 
     where orderid='$id' ")or die(mysqli_error($conn)) ;
if ($query2) {
	$query3=mysqli_query($conn,"DELETE FROM orders where orderid='$id' ").$conn->error;
	header('location:orders.php');

}
}



?>