<?php 
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];
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
 					 	 <div class="col-md-1">
                        <h4 class=" font-italic font-weight-normal"><a href="orders.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a></h4>
 					 	
 					 </div>
 					 	
 					 </div>
 					 <div class="col-md-12"><br>
 					 	<h4 class="text-center font-italic font-weight-normal">Pending Orders:</h4>
 					 </div>
 				</div><br>
 			<!-- 	<div class="row">
 					<div class="col-md-4">
 						
 					</div> -->
 						<div class="col-md-12">
 	<table class="table table-bordered table-responsive" style="font-size:13px">
 		<tr>
 			<th colspan="5">
 				<?php 
        include '../connection.php';
        $id=$_GET['id'];

        $see=mysqli_query($conn,"SELECT DISTINCT(C_id) from pending where orderid='$id' ");
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
 			<th colspan="3">
 				ORDER ID:<br><?php echo $id; ?>
     
 			</th>
 			<th>
 				
 				<a href="resend.php?order=<?php echo $id ;?>" class="text-info" style="text-decoration:none;"><i class="icofont-paper-plane icofont-2x"></i></a>
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
 		</tr>
 		<?php 
        include '../connection.php';
        $id=$_GET['id'];
        $see=mysqli_query($conn,"SELECT * from pending where orderid='$id' ");
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
 			<td style="font-size: 12;"><?php echo $res['TP']?></td>
 			<td><?php echo $res['GT']?></td> 

 		</tr>
 <?php 

}
 ?>
 	</table>
 </div>		
 					</div>
 					<div class="col-md-4">
 							
					 </div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>