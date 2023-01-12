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
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p> &nbsp;<a href="admin.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
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
 					 	<h4 class="text-center font-italic font-weight-normal">REPORTS:</h4>
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="reports.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-paper icofont-2x" ></i><br>CASHIER REPORT</a>
 					 		<!-- <a href="cashiers.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-bill icofont-2x"><br></i>CASHIER</a>
 					 		<a href="#.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-coins icofont-2x"><br></i>ACCOUNTANT</a> -->
 					 	</div>
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="debtss.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold" target="blank"><i class="icofont-paper icofont-2x" ></i><br>DEBTS REPOTRS</a>
 					 		<!-- <a href="production.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-gears icofont-2x"><br></i>PRODUCTION</a>
 					 		<a href="company.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-company icofont-2x"><br></i>COMPANY TRANSACTIONS</a> -->
 					 	</div>
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="#.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-file-alt icofont-2x"></i><br>SAMPLE</a>
 					 		
 					 	</div>
 					</div>
					 </div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>
