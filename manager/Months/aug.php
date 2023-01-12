<?php 
require_once('../../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];
$id=$_GET['id'];

$month="08";
$_SESSION['month']=$month;
$year=date("Y");

include '../../connection.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>RSM</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../icofont/icofont.min.css">
  <link rel="stylesheet" href="../../icofont/icofont.css">
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
        <center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="well shadow-sm bg-white p-2">
        <div class="row">
           <div class="col-md-12">
  
                        <h4 class=" font-italic font-weight-normal"><a href="../comdef.php?id=<?php echo $id?>" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a></h4>
            
           </div>
        </div><br>
        <div class="row"> 
            <div class="col-md-3">
             <a href="../comdef.php?id=<?php echo $id?>"  style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">January</button></a><br>

             <a href="feb.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">February</button></a><br>

             <a href="mar.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">March</button></a><br>

             <a href="apr.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">April</button></a><br>
             <a href="may.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">May</button></a><br>
             <a href="jun.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">June</button></a><br>
             <a href="jul.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">July</button></a><br>
             <a href="aug.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">August</button></a><br>
             <a href="sep.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">September</button></a><br>
             <a href="oct.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">October</button></a><br>
             <a href="nov.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">Novemver</button></a><br>
             <a href="dec.php?id=<?php echo $id?>" style="text-decoration:none; color: white;"><button class="btn btn-info btn-sm w-100">December</button></a><br>
            </div>
            <div class="col-md-6">
              
                <?php 
                $bring = mysqli_query($conn,"SELECT DISTINCT(orderid)  from orders where comid='$id' and date between '$year-$month-01' and '$year-$month-31' ");
        while ($fetch=mysqli_fetch_array($bring)) {
    $a=$fetch['orderid'];


$list=mysqli_query($conn,"SELECT sum(TS) as sum,date from orders where date between '$year-$month-01' and '$year-$month-31' and orderid='$a' GROUP BY date ");
while ($row=mysqli_fetch_array($list)) {
?>
<table>
  <tr>
    <td>
<div class="alert alert-warning">
  ORDER ID:
  <?php echo $a ?>
  </div>
</td>
<td>
  <div class="alert alert-warning">
  Date: 
  <?php echo $row['date']?>
</div>
</td>
<td>
  <div class="alert alert-warning">
  Totatl Size: 
  <?php echo $row['sum']?>
</div>
</td>
  </tr>
  </table>
<?php
}

}
         ?>
          <?php 
        $q1=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '$year-$month-01' and '$year-$month-31' and comid='$id' ");
        $f1=mysqli_fetch_array($q1);
        $r1=$f1['sum'];
        ?>   
        <div class="alert alert-warning"><?php echo "MONTHLY TOTAL SIZES: ".$r1; ?></div> 
            </div>  
            <div class="col-md-3">
              <a href="../printcom.php?id=<?php echo $id?>" target="blank" class="btn btn-dark btn-sm">Print</a>
            </div>  
          </div>
          
        </div><br><br>
      </div>
    </div>
  </div>
 </div>
</body>
</html>