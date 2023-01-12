<?php
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];
include '../connection.php';

$alertclass="";
$alertmess="";

$id=$_GET['id'];
if (isset($_POST['pay'])) {
    $method=$_POST['method'];
    $pay=$_POST['paid'];

    $ord=mysqli_query($conn,"SELECT GT from orders where orderid='$id' and end='end' and vis='invisible' ");
    $or=mysqli_fetch_array($ord);
    $o=$or['GT'];

   
    $start=mysqli_query($conn,"SELECT * from money where orderid='$id' ");
    $star=mysqli_fetch_array($start);
    @$sta=$star['orderid'];
    @$a=$star['pay1'];
    @$b=$star['method1'];
    @$c=$star['pay2'];
    @$d=$star['method2'];
    @$g=$star['reste'];

    if (empty($sta)) {

        $left=$o-$pay;
        $query1=$conn->query("INSERT into money VALUES('$id','$pay','$method','','','$left')") or die(mysql_error($conn)) ;

    }elseif ( !empty($a) && !empty($b) ) {
        if (empty($c) && empty($d) ) {
            if ( empty($e) && empty($f) ) {
                $pay2=$a+$pay;
                $left2=$o-$pay2;
        $query1=mysqli_query($conn,"UPDATE money set  pay2='$pay',method2='$method',reste='$left2' where orderid='$id' ");
        if ($query1) {
            
        }
            }
        }   

    }else{
        echo "Order paid";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>RSM</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../icofont/icofont.min.css">
	<link rel="stylesheet" href="../icofont/icofont.css">
</head>
<style type="text/css">
	#fun{
		display: none;
	}
</style>
<body class="bg-warning">
 <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="well shadow p-1 bg-light border-bottom border-info">
                <div class="well p-2">
                    <h3 class="display-4 font-weight-normal  text-info text-center " style="font-family: Quicksilver">RSM</h3>

                </div>
                <center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center>
                &nbsp;<a href="done.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
        
            <div class="well shadow-sm bg-white p-2">
                <div class="row">
                     <div class="col-md-4">
                        
                     </div>
                     <div class="col-md-4"><br>
                        <h4 class="text-center font-italic font-weight-normal"></h4>
                     </div>
                     <div class="col-md-4">
                         
                     </div>
                </div><br>
                <div class="row">
                    <div class="col-md-8">
                       <table class="table table-bordered table-responsive" style="font-size:13px">
        <tr>
            <th colspan="4">
                <?php 
        include '../connection.php';
        $id=$_GET['id'];

        $see=mysqli_query($conn,"SELECT DISTINCT(C_id) from orders where orderid='$id' ");
        while($resi=mysqli_fetch_array($see)){
        $cli=$resi['C_id'];
        $quer=mysqli_query($conn,"SELECT * from clients where C_id='$cli' ");
        $fet=mysqli_fetch_array($quer);
        $fir=$fet['firstname'];
        $las=$fet['lastname'];
        $con=$fet['client_contact'];
}
        ?>
        Names:<?php echo $fir."&nbsp".$las."<br>"; ?>
        Contact:<?php echo $con ?>
            </th>
            <th colspan="2">
                ORDER ID: <?php echo $id; ?>
     
            </th>
            <th>
                <a href="deliverprint.php?order=<?php echo $id ;?>" class="text-info" style="text-decoration:none;"><i class="icofont-printer icofont-2x"></i></a>
            </th>
          
            
        </tr>
        <tr>
            <th>Date</th>
            <th>Destination</th>
            <th>Type</th>
            <th>UP</th>
            <th>Size</th>
            <th>Piece</th>
            <th>TS</th>
        </tr>
        <?php 
        include '../connection.php';
        $id=$_GET['id'];
        $see=mysqli_query($conn,"SELECT * from orders where orderid='$id' ");
        while($res=mysqli_fetch_array($see)){
        ?>
        
        <tr>
            <td><?php echo $res['date']?> </td>
            <td><?php echo $res['destination']?> </td>
            <td><?php echo $res['itemtype']?> </td>
            <td><?php echo $res['UP']?> </td>
            <td><?php echo $res['size']?> </td>
            <td><?php echo $res['piece']?> </td>
            <td><?php echo $res['TS']?> </td>

        </tr>
 <?php 

}
 ?>
      
 </tr>
    </table>  
                    </div>
                    <div class="col-md-4">
                      
                            <form method="post" class="form-control" style="height: auto;">
                                <?php
                                $show=mysqli_query($conn,"SELECT * FROM delivery where orderid='$id' ");
                                $fetc=mysqli_fetch_array($show);
                                @$drive=$fetc['driver'];
                                @$num=$fetc['number'];
                                @$plat=$fetc['plate']; 
                                @$date=$fetc['date'];
                                @$time=$fetc['time'];

                                ?>
                                <input type="text" name="driver" placeholder="Driver" class="form-control" value="<?php echo @$drive?>" readonly>
                                <input type="text" name="number" placeholder="Tel" class="form-control" value="<?php echo @$num?>" readonly>
                                <input type="text" name="plate" placeholder="Plate Number" class="form-control" value="<?php echo @$plat?>" readonly>
                                <input type="text" name="plate" placeholder="Plate Number" class="form-control" value="<?php echo @$date?>" readonly >
                                <input type="text" name="plate" placeholder="Plate Number" class="form-control" value="<?php echo @$time?>" readonly >
                                <label class="label">Total sizes:</label>
                                 <select name="type" class="form-control">
          <?php 
          $bring = mysqli_query($conn,"SELECT itemtype  from orders where UP!='' and orderid='$id' ");
          while ($fetch=mysqli_fetch_array($bring)) {
            $type=$fetch['itemtype'];

          ?>
          <option value="<?php echo $type  ?>"><?php echo $type ?></option>
        <?php }?>
        </select>
        <label>Amount Taken</label>
        <input type="text" name="minus" class="form-control" ><br>
        <input type="submit" name="deliver" class="btn btn-sm btn-info w-100">

                                
                                <?php 
                                 if (isset($_POST['deliver'])) {
                                    $date=date("Y/m/d");
                                    $tel=$_POST['type'];
                                    $plate=$_POST['minus'];
                                    $bring=mysqli_query($conn,"SELECT SUM(piece) as ts from orders where orderid='$id' and itemtype='$tel' ");
                                    $brought=mysqli_fetch_array($bring);
                                    $bro=$brought['ts'];

                                    $master=$bro-$plate;

                                    $dist=mysqli_query($conn,"SELECT * from deliverhist where orderid='$id' ");
                                    $di=mysqli_fetch_array($dist);
                                    @$d=$di['orderid'];
                                    if ( $d=='' ) {
                                        $inserte=$conn->query("INSERT INTO deliverhist VALUES('$id','$tel','$bro','$master'  ) ") or die(mysqli_error($conn));
                                        $inserter=$conn->query("INSERT INTO deliverhistory VALUES('$id','$plate','$date','$tel'  ) ") or die(mysqli_error($conn)) ;


                                    }elseif ( $d!='' ) {

                                        $select=mysqli_query($conn,"SELECT orderid from deliverhist where orderid='$id' and itemtype='$tel'  ");
                                        $sel=mysqli_fetch_array($select);
                                        @$se=$sel['orderid'];

                                        if ( $se=='' ) {

                                            $inserte=$conn->query("INSERT INTO deliverhist VALUES('$id','$tel','$bro','$master'  ) ") or die(mysqli_error($conn)) ;

                                        }elseif ( $se!='' ) {
                                            $bring1=mysqli_query($conn,"SELECT reste from deliverhist where orderid='$id' and itemtype='$tel' ");
                                            $brought1=mysqli_fetch_array($bring1);
                                            $bro1=$brought1['reste'];
                                            $og=$bro1-$plate;   

                                            $inserte1=$conn->query("UPDATE deliverhist set reste='$og' where orderid='$id' and itemtype='$tel' ")or die(mysqli_error($conn));
                                        }

                                        $inserter=$conn->query("INSERT INTO deliverhistory VALUES('$id','$plate','$date','$tel'  ) ")or die(mysqli_error($conn));
                                    }
                                   

                                    
                                                      }

                                ?>

                            </form>  
                    </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ItemTaken</th>
                                    <th>Amount</th>
                                    <th>date</th>
                                </tr>
                             <?php 
                             $brin=mysqli_query($conn,"SELECT * from deliverhist where orderid='$id' ");
                             $brin1=mysqli_query($conn,"SELECT * from deliverhistory where orderid='$id' ");
                             while ($fetch=mysqli_fetch_array($brin1)) {

                             ?>
                             
                                 <tr>
                                     <td><?php echo $fetch['itemtype'] ?></td>
                                     <td><?php echo $fetch['taken1'] ?></td>
                                     <td><?php echo $fetch['date'] ?></td>
                                 </tr>
                             <?php }?>
                         
                         </table>
                         <table class=" table table-bordered">
                            <tr>
                                <th>ItemType</th>
                                <th>Total Size</th>
                                <th>Left</th>
                            </tr>
                            <?php
                         while ($row=mysqli_fetch_array($brin)) {
                             # code...

                         ?>
                                 <tr>
                                     <th><?php echo $row['itemtype'] ?></th>
                                     <th><?php echo $row['total'] ?></th>
                                     <th><?php echo $row['reste'] ?></th>
                                 </tr>
                             
                         <?php }?>
                         </table>
                         </div>
                     </div>
                </div>
            </div>
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
</style>,