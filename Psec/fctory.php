<?php  

include '../connection.php';
$id=$_GET['id'];

$query=mysqli_query($conn,"UPDATE orders set factory='view' where orderid='$id' ");
if ($query) {
	header('location:files.php');
}else{
    echo "string".$conn->error;
}
?>