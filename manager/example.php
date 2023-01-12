<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php 
include '../connection.php';

$fish=mysqli_query($conn,"SELECT username from accounts where username='ADM'");
$fis=mysqli_fetch_array($fish);
$fi=$fis['username'];

$query2 =mysqli_query($conn, "SELECT * from orders order by orderid desc limit 1");
$row = mysqli_fetch_array($query2);
$lastid="";

if (empty($lastid)){

    $orderid=substr($lastid,3); 
	$orderid=intval($orderid);
	$orderid=$fi.($orderid+1);
	echo $orderid;
	
}else{

	
}
?>
</body>
</html>