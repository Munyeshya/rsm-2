<?php
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

$name=$_SESSION['username'];
include '../connection.php';

$alertclass="";
$alertmess="";

$id=$_GET['id'];
$orders=mysqli_query($conn,"SELECT C_id from orders where orderid='$id' and end='end'");
$now=mysqli_fetch_array($orders);

$c=$now["C_id"];    
$client=mysqli_query($conn,"SELECT * FROM clients where C_id='$c' ");
$clien=mysqli_fetch_array($client);
$fname=$clien['firstname'];
$lname=$clien['lastname'];
$fullname=ucfirst($fname."  ".$lname);

if (isset($_POST['pay'])) {
    $method=$_POST['method'];
    $pay=$_POST['paid'];
    $date=date("y-m-d");

//Retrieve total payment
    $ord=mysqli_query($conn,"SELECT GT from orders where orderid='$id' and end='end' and vis='invisible' ");
    $or=mysqli_fetch_array($ord);
    $o=$or['GT'];


$query2 =mysqli_query($conn, "SELECT * from money where orderid='$id' order by id desc limit 1");
$retrieve=mysqli_fetch_array($query2);
@$paye=$retrieve['pay1'];
@$reste=$retrieve['reste'];
if ( empty($paye) ) {
    
    if ( $pay <= $o ) {
        $left=$o-$pay;
        $inserte=$conn->query("INSERT into money(names,orderid,pay1,method1,date,reste) VALUES('$fullname','$id','$pay','$method','$date','$left') ") or die(mysqli_error($conn));
        $inserter=$conn->query("INSERT into moneyhist(orderid,pay1,method1,date,reste) VALUES('$id','$pay','$method','$date','$left') ")or die(mysqli_error($conn));
    }elseif( $pay > $o ){
        // $alertclass="alert alert-danger";
        // $alertmess="Overpayment Detected".$conn->error;
        echo "$pay"."----"."$o";
    }
    

}
elseif( !empty($paye)  ){
    if ($pay <= $reste ) {
        $left=$reste-$pay;
        $finally=$paye+$pay;
        $inserte2=$conn->query("INSERT into moneyhist (orderid,pay1,method1,date,reste) VALUES('$id','$pay','$method','$date','$left')") or die(mysqli_error($conn));
        $finale=$conn->query("UPDATE money set pay1='$finally',reste='$left' where orderid='$id' ")or die(mysqli_error($conn));
        // code...
    }else{
        $alertclass="alert alert-danger";
        $alertmess="Invalid Payment".$conn->error;
    }

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
                &nbsp;<a href="orhistory.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
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
                        <h4 class="text-center font-italic font-weight-normal">Approve Order:</h4>
                     </div>
                     <div class="col-md-4">
                         
                     </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                       <table class="table table-bordered table-responsive" style="font-size:13px">
        <tr>
            <th colspan="5">
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
                ORDER ID:<br><?php echo $id; ?>
     
            </th>
            <th>
                
              <a href="cashprint.php?order=<?php echo $id ;?>" target="blank" class="text-info" style="text-decoration:none;"><i class="icofont-printer icofont-2x" ></i></a>  
            </th> 
            <th>
                
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
            <th>TP</th>
            <th>GT</th> 
            <th>
                Update
            </th>
        </tr>
        <?php 
        include '../connection.php';
        $id=$_GET['id'];
        $see=mysqli_query($conn,"SELECT * from orders where orderid='$id' ");
        while($res=mysqli_fetch_array($see)){
        ?>
        
        <tr>
            <form method="post" action="bts.php?id=<?php echo $res['id'] ?>">
            <td><?php echo $res['date']?> </td>
            <td><?php echo $res['destination']?> </td>
            <td><?php echo $res['itemtype']?> </td>
            <?php
            if($res['UP'] !='' ){
            ?>
            <td><input type="text" name="up" value="<?php echo $res['UP']?>" style="width:50px"> </td>
            <?php
            }else{
            ?>
            <td></td>
            <?php
            }?>
            <td><input type="text" name="size" value="<?php echo $res['size']?>" style="width:50px"> </td>
            <td><input type="text" name="piece" value="<?php echo $res['piece']?>" style="width:50px"> </td>
            <td><?php echo $res['TS']?> </td>
            <td style="font-size: 12;"><?php echo $res['TP']?></td>
            <td><?php echo $res['GT']?></td>
            <td><input type="submit" name="submit" class="btn btn-sm btn-info" value="Save"></td>
           </form>


        </tr>
 <?php 

}
 ?>
      
 </tr>
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
</style>
<?php
}else{
  header('location:../index.php');
}
?>