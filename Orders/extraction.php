<?php  
include '../connection.php';
$id=$_GET['id'];
$moral=mysqli_query($conn,"SELECT orderid from orders where id='$id' ");
$fetch=mysqli_fetch_array($moral);
$orderid=$fetch['orderid'];


$select=mysqli_query($conn,"SELECT * from orders where orderid='$orderid'");
$fetch=mysqli_fetch_array($select);
$clid=$fetch['C_id'];
$op=$fetch['operator'];
$item=$fetch['itemtype'];
$destin=$fetch['destination'];
$date=$fetch['date'];
$up=$fetch['UP'];
$sz=$fetch['size'];
$pc=$fetch['piece'];
$tots=$fetch['TS'];

$_SESSION['id']=$id;
 if (isset($_POST['change'])) {
     $nsize=$_POST['nsize'];
     $npiece=$_POST['npiece'];
     $ns=$sz-$nsize;
     $np=$pc-$npiece;
     $update=mysqli_query($conn,"UPDATE orders set n_size='$ns',n_piece='$np' where id='$id'   ");
     if ($update) {
           header("location:extra.php?id=$orderid");
     }

       }

?>