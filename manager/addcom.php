<?php 
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
include '../connection.php';
$alertclass="";
$alertmess="";
if (isset($_POST['submit'])) {
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$contact=$_POST['contact'];

	
	$query=mysqli_query($conn,"INSERT INTO commissioners VALUES ('', '$firstname', '$lastname','$contact')");
		if ($query) {
			$alertclass="alert alert-success";
			$alertmess="Commissioner Added";
		}
		// else{
		//     $alertclass="alert alert-danger";
		// 	$alertmess="Operation Failed";	
		// }	
}
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
 	<div class="row">
 	<div class="col-xl-12">
 			<div class="well shadow p-1 bg-light border-bottom border-info">
 				<div class="well p-2">
 					<h3 class="display-4 font-weight-normal  text-info text-center " style="font-family: Quicksilver">RSM</h3>

 				</div>
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
 						&nbsp;<a href="com.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow-sm bg-white">
 				<br>
 				<div class="row">
 					 <div class="col-md-4">
 					 	<div class="well shadow-sm bg-light p-3 rounded">
 							<h4 class="text-center font-weight-normal font-italic">Register Commissioner</h4>
 							<form method="post" action="" class="form-group">
 								<div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
 								<label>Firstname</label>
 								<input type="text" name="firstname" class="form-control" required>
 								<label>Lastname</label>
 								<input type="text" name="lastname" class="form-control" required>
 								<label>Contact</label>
 								<input type="text" name="contact" class="form-control" pattern="07[2,3,8,9]{1}[0-9]{7}" >
 								<br>
<input type="submit" name="submit" class="btn btn-info" value="Register"> 
 							</form>
 						</div>
 					 </div>
 					<div class="col-md-8">
                   
 					</div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>