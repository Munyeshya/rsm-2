<?php 
require_once ('../session_helper.php');
if (isset($_SESSION['username'] )) {
  # code...

$name=$_SESSION['username'];

include '../connection.php';

$name=$_SESSION['username'];
$fish=mysqli_query($conn,"SELECT username from accounts where lastname='$name'");
$fis=mysqli_fetch_array($fish);
$fi=$fis['username'];

$query2 =mysqli_query($conn, "SELECT * from orders where operator='$name' order by orderid desc limit 1");
$row = mysqli_fetch_array($query2);
@$lastid=$row['orderid'];

$alertclass="";
$alertmess="";

@$cid=$_GET['id']; 
$_SESSION['ccid']=$cid;

if (isset($_POST['submit'])) {
    $com=$_POST['com'];
    @$n=$_POST['n'];
    $q=date("Y/m/d");
    $w=$_POST['destination'];
    $r=$_POST['itemtype'];
    $t=$_POST['Size'];
    $y=$_POST['Piece'];
    $z=$_POST['tv'];
    $bring=$_POST['UP'];
    $ts=$t*$y;
    @$value=$_POST['check'];

     @$query=mysqli_query($conn,"SELECT * FROM orders where operator='$name' order by id DESC LIMIT 1 ");
     @$fetch=mysqli_fetch_array($query);
     @$amp=$fetch['id'];
     @$lastid=$fetch['orderid'];
     @$end=$fetch['end'];
     @$type=$fetch['itemtype'];
     @$upi=$fetch['UP'];
     @$dest=$fetch['destination'];
     @$coma=$fetch['comid'];
     @$na=$fetch['n'];
     @$totalsize=$fetch['TS'];
     @$tv=$fetch['tv'];



if ( empty($value) && $lastid ==""){
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $orderid=substr($lastid,3); 
    $orderid=intval($orderid);
    $orderid=$fi.($orderid+1);

if ( $z=='') {
$e="1";
$tsi=$t*$y;
$quer0=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values ('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','','','cont','visible','$com','$n','$e' )")or die (mysqli_error($conn)) ;

}elseif ( $z!='' ){

$tsi=$t*$y*$z;
$quer0=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values ('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','','','cont','visible','$com','$n','$z' )")or die (mysqli_error($conn));
}
    
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!   
}elseif  ( empty($value) && $end=="end" ){
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $orderid=substr($lastid,3); 
    $orderid=intval($orderid);
    $orderid=$fi.($orderid+1);  
    
if ($z=='') {
$e="1";
$tsi=$t*$y;
$quer1=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','','','cont','visible','$com','$n','$e' )")or die (mysqli_error($conn));
}elseif ( $z!='' ){

$tsi=$t*$y*$z;
$quer1=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','','','cont','visible','$com','$n','$z' )")or die (mysqli_error($conn));
}

     
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
}elseif( empty($value) && $end=="cont" ){
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  if ($r!=$type) {
         $broth=mysqli_query($conn,"SELECT sum(TS) as sum from orders where operator='$name'  and itemtype='$type' and orderid='$lastid' ");
         $brot=mysqli_fetch_array($broth);
         $t_sum=$brot['sum'];
         @$tot_price=$upi*$t_sum;

         $quer4=mysqli_query($conn,"UPDATE orders set TP='$tot_price' where id='$amp' "); 
if ($z=='') {
  
$e="1";         
$tsi=$t*$y;
$quer2=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','','','cont','visible','$coma','$na','$e')")or die (mysqli_error($conn));
}elseif ($z!='') {

$tsi=$t*$y*$z;
$quer2=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','','','cont','visible','$coma','$na','$z')")or die (mysqli_error($conn));

}
  }elseif ( $r==$type ) {
   
$tsi=$t*$y*$tv;
$quer2=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','','','cont','visible','$coma','$na','$tv')")or die (mysqli_error($conn));
}
  



    
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!   
}elseif (!empty($value) && $end=="cont" ) {
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     if ($r==$type) {   

$tsi=$t*$y*$tv;
$quer3=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','','','end','visible','$coma','$na','$tv')")or die (mysqli_error($conn));
     
    if ($quer3) {
         $munye=mysqli_query($conn,"SELECT sum(TS) as sum from orders where operator='$name'  and itemtype='$type' and orderid='$lastid' ");
         $muny=mysqli_fetch_array($munye);
         $to_sum=$muny['sum'];
         $toto_price=$bring*$to_sum;
         $upde=mysqli_query($conn,"UPDATE orders set TP='$toto_price' where end='end' and orderid='$lastid'  ");
             if ($upde) {

             $brother=mysqli_query($conn,"SELECT sum(TP) as summ from orders where operator='$name' and orderid='$lastid' ");
             $brothe=mysqli_fetch_array($brother);
             $g_sum=$brothe['summ'];

             $upd=mysqli_query($conn,"UPDATE orders set GT='$g_sum' where orderid='$lastid'and end='end' ");
             }
    }
    
}elseif( $r != $type ){

         $broth=mysqli_query($conn,"SELECT sum(TS) as sum from orders where operator='$name'  and itemtype='$type' and orderid='$lastid' ");
         $brot=mysqli_fetch_array($broth);
         $t_sum=$brot['sum'];
         $tot_price=$upi*$t_sum;
         


         $quer4=mysqli_query($conn,"UPDATE orders set TP='$tot_price' where id='$amp' ").$conn->error; 
         if($quer4){
if($z==''){
$e="1";
$tsi=$t*$y;	
$tipi=$bring*$tsi;
$quer11=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','$tipi','','end','visible','$coma','$na','$e')")or die (mysqli_error($conn));

$giti=mysqli_query($conn,"SELECT sum(TP) as save from orders where orderid='$lastid' ");
$gitii=mysqli_fetch_array($giti);
$gitiii=$gitii['save'];

            if ($quer11) {
                $saveme=mysqli_query($conn,"UPDATE orders set GT='$gitiii' where orderid='$lastid' and end='end' ");
            }
        }elseif($z!=''){
$tsi=$t*$y*$z;	
$tipi=$bring*$tsi;
$quer11=$conn->query("INSERT into orders(orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv) values('$lastid','$cid','$name','$r','$bring','$dest','$q','$t','$y','$tsi','$tipi','','end','visible','$coma','$na','$z')")or die (mysqli_error($conn));

$giti=mysqli_query($conn,"SELECT sum(TP) as save from orders where orderid='$lastid' ");
$gitii=mysqli_fetch_array($giti);
$gitiii=$gitii['save'];

            if ($quer11) {
                $saveme=mysqli_query($conn,"UPDATE orders set GT='$gitiii' where orderid='$lastid' and end='end' ");
            }
        }
     }
        


}
      
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
}elseif (!empty($value) && $end=="end") {
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $orderid=substr($lastid,3); 
    $orderid=intval($orderid);
    $orderid=$fi.($orderid+1);  
if ($z=='') {
$e="1";
$tsi=$t*$y;
$tp=$bring*$tsi;
     $query1=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','$tp','$tp','end','visible','$com','$n','$e')")or die (mysqli_error($conn));

}elseif ( $z!='' ){

$tsi=$t*$y*$z;
$tp=$bring*$tsi;
     $query1=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','$tp','$tp','end','visible','$com','$n','$z')")or die (mysqli_error($conn));
}

 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!   
}elseif (!empty($value) && $end==""){
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $orderid=substr($lastid,3); 
    $orderid=intval($orderid);
    $orderid=$fi.($orderid+1);

if ($z=='') {
$e="1";
$tsi=$t*$y;
$tp=$bring*$tsi;
$query1=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','$tp','$tp','end','visible','$com','$n','$e')")or die (mysqli_error($conn));

}elseif ( $z!='' ){

$tsi=$t*$y*$z;
$tp=$bring*$tsi;
$query1=$conn->query("INSERT into orders (orderid,C_id,operator,itemtype,UP,destination,date,size,piece,TS,TP,GT,end,vis,comid,n,tv)values('$orderid','$cid','$name','$r','$bring','$w','$q','$t','$y','$tsi','$tp','$tp','end','visible','$com','$n','$z')")or die (mysqli_error($conn));
}

    
}else{
    echo "None of that works"; 
}
}
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>RSM </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icofont/icofont.min.css">
    <link rel="stylesheet" href=".//icofont/icofont.css">
</head>
<body class="bg-warning">
 <div class="container">
    <!-- <div class="row"> -->
    <div class="col-md-12">
            <div class="well shadow p-1 bg-light border-bottom border-info">
                <div class="well p-1">
                    <h3 class="display-4 font-weight-normal  text-info text-center " style="font-family: Quicksilver">RSM</h3>

                </div>
                <center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
                        <a href="orders.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
            </div>
        </div>
    </div>
 <!--   <div class="row"> -->
        <div class="col-md-12">
            <div class="well shadow-sm bg-white">
                <br>
                <div class="row">
                     <div class="col-md-12">
                        <h4 class="text-center font-italic font-weight-normal"><a href="viewclient.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a><a href="ordering.php?id=<?php echo $cid ?>" class="text-info" style="text-decoration:none;">|<i class="icofont-refresh icofont-1x"></i></a></h4>
                        <div class="well shadow-sm bg-light p-3 rounded">
                            <div class="alert alert-primary" style="text-align: center;"><i class="icofont-ui-user"></i> <?php echo ucwords($name) ?>    &nbsp |Create An Order</div>
                            <h4 class="text-center font-weight-normal font-italic"></h4>
                            <div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                        <table class="table table-borderless ">

    <tr>
        <th colspan="2">
            <label>Destination</label>
            <input type="text" name="destination" class="form-control" >
        </th>
    </tr>
    <tr>
            <th colspan="2">
            <label>Item Type</label>
            <input type="text" name="itemtype" class="form-control" required="" >
        </th>
    </tr>
        <tr>
        <th>
            <label>Item Size</label>
            <input type="text" name="Size" class="form-control" required="" >
            
        </th>
        <th>
            <label>Unit Price</label>
            <input type="text" name="UP" class="form-control" >
        </th>
    </tr>
    <tr>
        <th>
            <label>Piece</label>
            <input type="number" name="Piece" class="form-control" >
        </th>
        <th>
            <label>Commisioner</label>
            <input type="number" name="com" class="form-control" >
        </th>
        </tr>
        <tr>
            <th>
            <label>TV</label>
            <input type="text" name="tv" class="form-control" >
            </th>
        </tr>
        <tr>
            <th><input type="checkbox" name="check" value="check">&nbsp End of order</th>
            <th><input type="checkbox" name="n" value="n">&nbsp N</th>
        </tr>
</table>                            

<input type="submit" name="submit" class="btn btn-info" value="Order"> 
                            </form>
 </div>
 <div class="col-md-8">
    <table class="table table-bordered table-responsive" style="font-size:13px">
        <tr>
            <th colspan="2">
                ORDER ID:
       <?php 
       $saturn=mysqli_query($conn,"SELECT orderid from orders where operator='$name' and vis='visible'");
       $st=mysqli_fetch_array($saturn);
       @$sun=$st['orderid'];
       echo $sun."<br><br>";

        ?>
        <form method="post">
            <button type="submit" name="clear" class="btn-sm btn-danger icofont-ui-close"></button>
            <?php 
            if (isset($_POST['clear'])) {
                $query=mysqli_query($conn,"SELECT * from orders where orderid='$sun' order by id desc limit 1");
                $quer=mysqli_fetch_array($query);
                $res=$quer['id'];
                $delete=mysqli_query($conn,"DELETE from orders where id='$res' ");
               
            }
            ?>
        </form>
            </th>   
            <th colspan="4">
                <?php include('../connection.php');  
                $dade=mysqli_query($conn,"SELECT comid,date,destination from orders where orderid='$sun' ");
                $dad=mysqli_fetch_array($dade);
                @$odate=$dad['date'];
                @$odest=$dad['destination'];
                @$ocom=$dad['comid'];
                 $cm1=mysqli_query($conn,"SELECT * FROM commissioners where comid='$ocom'");
                $c=mysqli_fetch_array($cm1);
                @$cfname=$c['firstname'];
                @$clname=$c['lastname'];


                $query=mysqli_query($conn,"SELECT *from clients where C_id ='$cid';"); 
                $fetch=mysqli_fetch_array($query);
                ?>
                Name:<?php echo $fetch['firstname']."&nbsp".$fetch['lastname']; ?><br>
                Contact:<?php echo $fetch['client_contact'];?><br>
                Date:<?php  echo $odate ?><br>
                Destination:<?php echo $odest?><br>
                Com:<?php echo $cfname." ".$clname; ?>

            </th>       
            <th>
                
                <div class="btn-group" role="group" aria-label="Basic example">

                <a href="pending.php?orderid=<?php echo $sun;?>" class="btn btn-outline-dark btn-sm">Pending<i class="icofont-paper-plane"></i></a>
                    <!--<a href="invoice.php?orderid=<?php echo $sun;?>" class="btn btn-outline-dark btn-sm">Print<i class="icofont-print"></i></a>-->
                   
                   

                 </div>
            </th>
        </tr>
        <tr>
            <th>Type</th>
            <th>UP</th>
            <th>Size</th>
            <th>Piece</th>
            <th>TS</th>
            <th>TP</th>
            <th >GT</th>
        </tr>
        <?php 
        include '../connection.php';
        $see=mysqli_query($conn,"SELECT * from orders where operator='$name' and vis='visible'");
        while($res=mysqli_fetch_array($see)){
            $tp=$res['TP'];
            $gt=$res['GT'];
        ?>
        <tr>
            <th><?php echo $res['itemtype']?> </th>
            <th><?php echo $res['UP']?> </th>
            <th><?php echo $res['size']?> </th>
            <th><?php echo $res['piece']?> </th>
            <th><?php echo $res['TS']?> </th>
            <th><?php if ($tp!=''){ echo number_format( $tp );}else{ echo $tp;}?></th>
            <th><?php if ($gt!=''){ echo number_format( $gt);}else{echo $gt;}?></th>
        </tr>
    <?php }?>
    </table>
 </div>     
 </div>                 
                    </div>
                </div><br>
                
        </div>
    </div>
 </div>
</body>
</html>
<style type="text/css">
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    border-radius: 7px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
</style>
<?php 
}else{
    header('location:../index.php');
  }
?>