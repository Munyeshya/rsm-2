<?php
require_once('../session_helper.php');
if ($_SESSION['username']) {
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
    $sta=$star['orderid'];
    @$a=$star['pay1'];
    @$b=$star['method1'];
    @$c=$star['pay2'];
    @$d=$star['method2'];
    @$g=$star['reste'];

    if (empty($sta)) {

        $left=$o-$pay;
        $query1=mysqli_query($conn,"INSERT into money VALUES('$id','$pay','$method','','','$left')");

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
                &nbsp;<a href="pm.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
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
                    <div class="col-md-9">
                       <table class="table table-bordered table-responsive" style="font-size:13px">
        <tr>
            <th colspan="2">
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
            <th colspan="3">
               
                <div class="btn-group" role="group" aria-label="Basic example">
                  
                    <a href="facprint.php?orderid=<?php echo $id;?>" class="btn btn-dark btn-sm" target="blank">Factory<i class="icofont-print"></i></a>
                    <a href="fileprint.php?orderid=<?php echo $id;?>" class="btn btn-dark btn-sm" target="blank">File<i class="icofont-print"></i></a>
  
                <a href="fctory.php?id=<?php echo $id; ?>" class="btn btn-dark btn-sm"><i class="icofont-paper-plane "></i> </a>
                 </div>
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
                    <div class="col-md-3">
 
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