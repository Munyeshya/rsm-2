<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
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
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center>
 					  &nbsp;<a href="admin.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
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
 					 	<h4 class="text-center font-italic font-weight-normal">Production Fields:</h4>
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="pm.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-labour  icofont-2x"></i><br>Production Manager</a>
 					 		<a href="files.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-library icofont-2x"><br></i>
 					 		Production Files manager</a>
 					 	</div>
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2  bg-light border-bottom border-top border-info">
 					 		<a href="psec.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-architecture-alt icofont-2x" ></i><br>Production Secretary</a>
 					 		
 					 		<a href="factory.php" class="btn btn-info btn-block rounded-4" style="font-family: Poppins ExtraBold"><i class="icofont-industries icofont-2x"><br></i>Factory</a>
 					 	</div>
 					</div>
 					<div class="col-md-4">
 							
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