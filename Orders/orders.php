<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

$name=$_SESSION['username'];
include '../connection.php';
$alertclass="";
$alertmess="";
if (isset($_POST['submit'])) {
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$client_contact=$_POST['client_contact'];
	$get_f=$conn->query("SELECT * FROM clients WHERE client_contact='$client_contact'") or die(mysqli_error($conn));
	$count=mysqli_num_rows($get_f);
	$row=mysqli_fetch_assoc($get_f);
	if ($count > 0) {
	 	$alertclass="alert alert-success";
	 	$alertmess="client Exist";
	 } 
	 else{
	 	$sql=$conn->query("INSERT INTO clients(firstname,lastname,client_contact) VALUES('$fname','$lname','$client_contact')") or die(mysqli_error($conn));
	 	if ($sql) {
	 		$alertclass="alert alert-success";
	 	    $alertmess="client Recorded";
	 	}
	 	else{
	 		$alertclass="alert alert-danger";
	 	    $alertmess="Operation Failed";
	 	}
	 }
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
	<link rel="stylesheet" href="../icofont/icofont.css">
</head>

<style type="text/css">
	#fun{
		display: none;
	};
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
 					&nbsp;<a href="logout.php" style="text-decoration: none;" class="text-info"><i class="icofont-logout"></i>&nbsp;Logout</a>
 			</div>
 		</div>
 	</div>
 	<!-- <div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div> -->
 	<div class="row">
 		<div class="col-xl-12">
 	 <div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div> 
 			<div class="well shadow-sm bg-light p-2">
 				<div class="row">
 					 <div class="col-md-4">
 					 	
 					 </div>
 					 <div class="col-md-4"><br>
 					 	<h4 class="text-center font-italic font-weight-normal"> Orders<i class="icofont-ui-cart icofont-1x" ></i></h4>
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-2">
 						
 					</div>
 					<div class="col-md-4">
 						<div class="well shadow-sm p-2">
 							<button class="btn btn-info btn-block rounded-4" onclick="opnum()">&nbsp;&nbsp;<i class="icofont-user-male icofont-1x" ></i>Record Client </button>
 							<div class="row">
 								<div class="col-md-12"> 
 									<div class="well shadow-sm bg-light p-3; background color:yellow;" id="fun" >
 										<form method="post" action="" class="form-group">
 											<label>Firstname</label><br>
 											<input type="text" name="fname" class="form-control" required>
 											<label>Lastname</label><br>
 											<input type="text" name="lname" class="form-control" required><br>
 											<label>Client contact/IBM</label><br>
 											<input type="text" name="client_contact" class="form-control"  pattern="[0-9]{9}" title="Use correct phone/EBM formart"><br>
 											<input type="submit" name="submit" class="btn btn-info btn-block rounded-0" value="Record">
 										</form>
 									</div>
 								</div>
 							</div><br>
 							<a href="viewclient.php" class="btn btn-block btn-info rounded-0"><i class="icofont-search-job icofont-1x" ></i> View clients&nbsp;</a>
 						</div>
 					</div>
 					<div class="col-md-4">
 							<div class="well shadow-sm p-2">
 							<a href="viewpeding.php" class="btn btn-info btn-block rounded-0"><i class="icofont-search-document"></i>Pending Orders</a><br>
 							<a href="all.php" class="btn btn-block btn-info rounded-0"><i class="icofont-search-job icofont-1x" ></i><b> N</b> orders&nbsp;</a>
 						</div>
 						</div>
 						<!-- <div class="well shadow-sm p-2">
 							<a href="vieworders.php" class="btn btn-info btn-block rounded-0"><i class="icofont-search-document"></i> View Orders</a>
 						</div> -->
 						
					 </div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>
<script type="text/javascript">
	function opnum() {
		document.getElementById('fun').style.display='block';
	}
</script>
<?php
}else{
  header('location:../index.php');
}
?>