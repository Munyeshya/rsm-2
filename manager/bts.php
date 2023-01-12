<?php 
include '../connection.php';
$id=$_GET['id'];
$query=mysqli_query($conn,"SELECT * FROM orders where id='$id' ");
$start=mysqli_fetch_array($query);
$first=$start['itemtype'];
$ord=$start['orderid'];
@$up1=$start['up'];
$cid=$start['C_id'];
$nam=mysqli_query($conn,"SELECT firstname,lastname from clients where C_id='$cid'  ");
$fetch=mysqli_fetch_array($nam);
$fnam=$fetch['firstname'];
$lnam=$fetch['lastname'];
$date=date("Y-m-d");


if(isset($_POST['submit'])){
    $size=$_POST['size'];
    $piece=$_POST['piece'];
    @$up=$_POST['up'];
  
if($up =='' ){
    $ts=$piece*$size;
    $op1=mysqli_query($conn,"UPDATE orders set TS='$ts' where id='$id' ");
    
    $second=mysqli_query($conn,"SELECT UP from orders where itemtype='$first' and orderid='$ord' order by id desc limit 1");
    $u=mysqli_fetch_array($second);
    $ups=$u['UP'];
    
    $third=mysqli_query($conn,"SELECT sum(TS) as ts from orders where itemtype='$first' and orderid='$ord' ");
    $t=mysqli_fetch_array($third);
    $tss=$t['ts'];
    
    $tp=$ups*$tss;
    $fourth=mysqli_query($conn,"UPDATE orders set TP='$tp' where itemtype='$first' and orderid='$ord' and UP!='' ");
    $fifth=mysqli_query($conn,"UPDATE orders SET size='$size',piece='$piece'  where id='$id' ");
    
    $sixth=mysqli_query($conn,"SELECT sum(TP) as tp from orders where  orderid='$ord' ");
    $g=mysqli_fetch_array($sixth);
    $gt=$g['tp'];
    
    $seco=mysqli_query($conn,"SELECT id from orders where  orderid='$ord' order by id desc limit 1");
    $us=mysqli_fetch_array($seco);
    $uss=$us['id'];
    
    $seventh=mysqli_query($conn,"UPDATE orders set GT='$gt' where orderid='$ord' and id='$uss' ");
    
//PAyment SHiiiit>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$alt1=mysqli_query($conn,"SELECT tot,pay1,reste from money where orderid='$ord' ");
$alt2=mysqli_fetch_array($alt1);
@$alt3=$alt2['pay1'];
@$alt4=$alt2['reste'];
@$alt5=$alt2['tot'];

$orde=mysqli_query($conn,"SELECT GT from orders where orderid='$ord' and end='end' and vis='invisible' ");
$or=mysqli_fetch_array($orde);
$o=$or['GT'];

if( $o > $alt3  ){
         $update2=mysqli_query($conn,"SELECT SUM(pay1) as sum from moneyhist  where orderid='$ord'");
         $sum=mysqli_fetch_array($update2);
         $sum2=$sum['sum'];
         
        $upd1=$o-$sum2;
        $upd2=mysqli_query($conn,"UPDATE money set reste='$upd1',pay1='$o',tot='$sum2'  where orderid='$ord' ");
        
}elseif($o < $alt3 ){
    $update2=mysqli_query($conn,"SELECT SUM(pay1) as sum from moneyhist  where orderid='$ord'");
    $sum=mysqli_fetch_array($update2);
    $sum2=$sum['sum'];
    
    $primary=mysqli_query($conn,"UPDATE money set pay1='$o'  where orderid='$ord'");
    
   if ( $o >= $alt5 ){
       $upd6=$o-$sum2;
       $upd7=mysqli_query($conn,"UPDATE money set reste='$upd6'  where orderid='$ord' ");
       
   }elseif( $o < $alt5 )

    $upd6=$alt5-$o  ;
    $upd7=mysqli_query($conn,"UPDATE money set reste='0',tot='$o'  where orderid='$ord' ");
    $insert=mysqli_query($conn,"INSERT INTO petty(names,purpose,cash,date,type) VALUES('$fnam','Refund','$upd6','$date','other expenses' ) ");
}
    
//PAyment SHiiiit>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   
    
}else if($up !='' ){
    $ts=$piece*$size;
    $op1=mysqli_query($conn,"UPDATE orders set TS='$ts' where id='$id' ");
    $update=mysqli_query($conn,"UPDATE orders set UP='$up' where itemtype='$first' and orderid='$ord' and UP!=''");
    
    if($update){
    $second=mysqli_query($conn,"SELECT UP from orders where itemtype='$first' and orderid='$ord' order by id desc limit 1");
    $u=mysqli_fetch_array($second);
    $ups=$u['UP'];
    
    $third=mysqli_query($conn,"SELECT sum(TS) as ts from orders where itemtype='$first' and orderid='$ord' ");
    $t=mysqli_fetch_array($third);
    $tss=$t['ts'];
    
    
    
    $tp=$ups*$tss;
    $fourth=mysqli_query($conn,"UPDATE orders set TP='$tp' where itemtype='$first' and orderid='$ord' and UP!='' ");
    $fifth=mysqli_query($conn,"UPDATE orders SET size='$size',piece='$piece'  where id='$id' ");
    
    $sixth=mysqli_query($conn,"SELECT sum(TP) as tp from orders where  orderid='$ord' ");
    $g=mysqli_fetch_array($sixth);
    $gt=$g['tp'];
    
    $seco=mysqli_query($conn,"SELECT id from orders where  orderid='$ord' order by id desc limit 1");
    $us=mysqli_fetch_array($seco);
    $uss=$us['id'];
    
    $seventh=mysqli_query($conn,"UPDATE orders set GT='$gt' where orderid='$ord' and id='$uss' ");
    
    //PAyment SHiiiit>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$alt1=mysqli_query($conn,"SELECT tot,pay1,reste from money where orderid='$ord' ");
$alt2=mysqli_fetch_array($alt1);
@$alt3=$alt2['pay1'];
@$alt4=$alt2['reste'];
@$alt5=$alt2['tot'];

$orde=mysqli_query($conn,"SELECT GT from orders where orderid='$ord' and end='end' and vis='invisible' ");
$or=mysqli_fetch_array($orde);
$o=$or['GT'];

if( $o > $alt3  ){
         $update2=mysqli_query($conn,"SELECT SUM(pay1) as sum from moneyhist  where orderid='$ord'");
         $sum=mysqli_fetch_array($update2);
         $sum2=$sum['sum'];
         
        $upd1=$o-$sum2;
        $upd2=mysqli_query($conn,"UPDATE money set reste='$upd1',pay1='$o',tot='$sum2'  where orderid='$ord' ");
        
}elseif($o < $alt3 ){
    $update2=mysqli_query($conn,"SELECT SUM(pay1) as sum from moneyhist  where orderid='$ord'");
    $sum=mysqli_fetch_array($update2);
    $sum2=$sum['sum'];
    
    $primary=mysqli_query($conn,"UPDATE money set pay1='$o'  where orderid='$ord'");
    
   if ( $o >= $alt5 ){
       $upd6=$o-$sum2;
       $upd7=mysqli_query($conn,"UPDATE money set reste='$upd6'  where orderid='$ord' ");
       
   }elseif( $o < $alt5 )

    $upd6=$alt5-$o  ;
    $upd7=mysqli_query($conn,"UPDATE money set reste='0',tot='$o'  where orderid='$ord' ");
    $insert=mysqli_query($conn,"INSERT INTO petty(names,purpose,cash,date,type) VALUES('$fnam','Refund','$upd6','$date','other expenses' ) ");
}
    
//PAyment SHiiiit>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    }
}
header("location:orpeek.php?id=$ord");
}
?>
