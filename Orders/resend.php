<?php
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
include '../connection.php';
$name=$_SESSION['username'];



$orded=$_GET['order'];


// $query2 =mysqli_query($conn, "SELECT * from orders where operator='$name' order by orderid desc limit 1");
// $row = mysqli_fetch_array($query2);
// $lastid=$row['orderid'];

// $orderid=substr($lastid,3); 
// $orderid=intval($orderid);
// $orderid=$fi.($orderid+1);
// $orderid=strtoupper($orderid);


// $quer=mysqli_query($conn,"UPDATE pending set vis='invisible' where orderid='$orded' ");
// if ($quer) {
// 	# code...

$queri=mysqli_query($conn,"UPDATE pending set vis='invisible' where orderid='$orded' ");

if ($queri) {

	$query6=mysqli_query($conn,"INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n)
SELECT orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n from pending where orderid='$orded' ");
	if ($query6) {
$change=mysqli_query($conn,"UPDATE orders set ord='view' where orderid='$orded' ")	 ;   
$query7=mysqli_query($conn,"DELETE from pending where orderid='$orded'");
if ($query7) {
	header('location:viewpeding.php');
}
		
	}
   
}

?>