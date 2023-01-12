<?php 
require_once ('../session_helper.php');

if (isset($_SESSION['username']) && isset($_SESSION['password']) ) {
  # code...
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
 					 <div class="col-md-4">
 					 	
 					 </div>
 					 <div class="col-md-4"><br>
 					 	<h4 class="text-center font-italic font-weight-normal">Fields:</h4>
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="orders.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-ui-cart icofont-2x" ></i><br>ORDERS</a>
 					 		<a href="cashiers.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-bill icofont-2x"><br></i>CASHIER</a>
 					 		<a href="#.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-coins icofont-2x"><br></i>ACCOUNTANT</a>
 					 	</div>
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="sales.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-chart-growth icofont-2x"></i><br>SALES</a>
 					 		<a href="production.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-gears icofont-2x"><br></i>PRODUCTION</a>
 					 		<a href="company.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-company icofont-2x"><br></i>COMPANY TRANSACTIONS</a>
 					 	</div>
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="signin.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-users-alt-3 icofont-2x"></i><br>Create Account</a>
 					 		<a href="com.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-connection icofont-2x"><br></i>COMMISSIONERS</a>
 					 		<a href="../logout.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-logout "><br></i>LOGOUT</a>
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
<?php
}else{
	header('location:../index.php');
  }

?>
