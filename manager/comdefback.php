<?php 
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];
$id=$_GET['id']
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
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow-sm bg-white p-2">
 				<div class="row">
 					 <div class="col-md-1">
 	
                        <h4 class=" font-italic font-weight-normal"><a href="com.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a></h4>
 					 	
 					 </div>
 					 <div class="col-md-12"><br>
 					 	<h4 class="text-center font-italic font-weight-normal">Commisioner sum UPs:</h4>
 					 </div>
 				</div><br>
 				<div class="row">	
 						<div class="col-md-12">
             
 	<?php 
include '../connection.php';
$query=mysqli_query($conn,"SELECT sum(TS) as sum from orders where comid ='$id' ");
  ?>
  <table class="table table-bordered table-responsive">
    <tr>
      <th>Jan</th>
      <th>Feb</th>
      <th>Mar</th>
      <th>Apr</th>
      <th>May</th>
      <th>Jun</th>
      <th>Jul</th>
      <th>Aug</th>
      <th>Sep</th>
      <th>Oct</th>
      <th>Nov</th>
      <th>Dec</th>
    </tr>
    <tr>
      <td>
        <?php 
        $q1=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-01-01' and '2022-01-31' and comid='$id' ");
        $f1=mysqli_fetch_array($q1);
        $r1=$f1['sum'];
        echo $r1;
         ?>
      </td>
      <td>
                <?php 
        $q2=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-02-01' and '2022-02-29' and comid='$id' ");
        $f2=mysqli_fetch_array($q2);
        $r2=$f2['sum'];
        echo $r2;
         ?>
      </td>
      <td>
                <?php 
        $q3=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-03-01' and '2022-03-31' and comid='$id' ");
        $f3=mysqli_fetch_array($q3);
        $r3=$f3['sum'];
        echo $r3;
         ?>
      </td>
      <td>
                <?php 
        $q4=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-04-01' and '2022-04-30' and comid='$id' ");
        $f4=mysqli_fetch_array($q4);
        $r4=$f4['sum'];
        echo $r4;
         ?>
      </td>
      <td>
                <?php 
        $q5=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-05-01' and '2022-05-31' and comid='$id' ");
        $f5=mysqli_fetch_array($q5);
        $r5=$f5['sum'];
        echo $r5;
         ?>
      </td>
      <td>
                <?php 
        $q6=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-06-01' and '2022-06-30' and comid='$id' ");
        $f6=mysqli_fetch_array($q6);
        $r6=$f6['sum'];
        echo $r6;
         ?>
      </td>
      <td>
                <?php 
        $q7=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-07-01' and '2022-07-31' and comid='$id' ");
        $f7=mysqli_fetch_array($q7);
        $r7=$f7['sum'];
        echo $r7;
         ?>
      </td>
      <td>
                <?php 
        $q8=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-08-01' and '2022-08-31' and comid='$id' ");
        $f8=mysqli_fetch_array($q8);
        $r8=$f8['sum'];
        echo $r8;
         ?>
      </td>
      <td>
                <?php 
        $q9=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-09-01' and '2022-09-30' and comid='$id' ");
        $f9=mysqli_fetch_array($q9);
        $r9=$f9['sum'];
        echo $r9;
         ?>
      </td>
      <td>
                <?php 
        $q10=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-10-01' and '2022-10-31' and comid='$id' ");
        $f10=mysqli_fetch_array($q10);
        $r10=$f10['sum'];
        echo $r10;
         ?>
      </td>
      <td>
                <?php 
        $q11=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-11-01' and '2022-11-30' and comid='$id' ");
        $f11=mysqli_fetch_array($q11);
        $r11=$f11['sum'];
        echo $r11;
         ?>
      </td>
      <td>
                <?php 
        $q12=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '2022-12-01' and '2022-12-31' and comid='$id' ");
        $f12=mysqli_fetch_array($q12);
        $r12=$f12['sum'];
        echo $r12;
         ?>
      </td>
    </tr>
  </table>
            </div>		
 					</div>
 					
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>