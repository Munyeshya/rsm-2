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
	$username=$_POST['username'];
	$contact=$_POST['contact'];
	$role=$_POST['role'];
	$password=$_POST['password'];
	
	$query=mysqli_query($conn,"INSERT INTO accounts (firstname,lastname,username,contact,role,password) VALUES ( '$firstname', '$lastname', '$username','$contact','$role', '$password')");
		if ($query) {
			$alertclass="alert alert-success";
			$alertmess="Account Created";
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
 						&nbsp;<a href="admin.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
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
 							<h4 class="text-center font-weight-normal font-italic">Create Account</h4>
 							<form method="post" action="" class="form-group">
 								<div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
 								<label>Firstname</label>
 								<input type="text" name="firstname" class="form-control" required>
 								<label>Lastname</label>
 								<input type="text" name="lastname" class="form-control" required>
 								<label>Username</label>
 								<input type="text" name="username" class="form-control" required>
 								<label>Contact</label>
 								<input type="text" name="contact" class="form-control" pattern="07[2,3,8,9]{1}[0-9]{7}" required>
 								<label>Role</label>
 								 <select class="form-control" name="role" required>
    <option value="0">Select Role:</option>
    <option value="orders" >Orders</option>
    <option value="cashier">Cashier</option>
    <option value="sales">Sales</option>
    <option value="production">Production Manager</option>
    <option value="psec">Production Secretary</option>
    <option value="file">File Manager</option>
    <option value="delivery">Delivery</option>
    <option value="admin">Admin</option>
    <option value="accountant">Accountant</option>
  </select>
 								<label>Password</label>
 								<input type="password" name="password" class="form-control" required><br>
<input type="submit" name="submit" class="btn btn-info" value="Create Account"> 
 							</form>
 						</div>
 					 </div>
 					<div class="col-md-8">
                   <table class=" table table-bordered table table-striped table-responsive" style="font-size:14px">
 								<tr>
 								<th>Firstname</th>
 									<th>Lastname</th>
 									<th>Username</th>
 									<th>Contact</th>
 									<th>Role</th>
 									<th>Password</th>
 									<th>Delete</th>
 								</tr>
 								<?php
 								include '../connection.php';
 								$select=mysqli_query($conn,"SELECT * FROM accounts");
 								while ($row=mysqli_fetch_array($select)) {
 								 	?>
 								 	<tr>
 								 		<td><?php echo ucfirst($row['firstname'])?></td>
 								 		<td><?php echo $row['lastname']?></td>
 								 		<td><?php echo $row['username']?></td>
 								 		<td><?php echo $row['contact']?></td>
 								 		<td><?php echo $row['role']?></td>
 								 		<td><?php echo $row['password']?></td>
 								 		<td><a href="delete2.php?id=<?php echo $row['ID']; ?>" style="text-decoration: none;"  class="text-danger">Delete<i class="icofont-ui-delete" title="Delete"></i></a></td>
 								 	</tr>
 								 	<?php
 								 } 
 								 ?>
 							</table>
 					</div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>