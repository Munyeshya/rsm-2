<?php 
session_start();
include 'connection.php';
$alertclass="";
$alertmess="";

$page1="orders.php";
$page2="cashiers.php";
$page3="admin.php";
$page4="production.php";
$page5="manager/admin.php";
$page6="accountant.php";
$page7="orders2.php";


$login="";
if (isset($_POST['submit'])) {
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="SELECT * FROM accounts where lastname='$user' and password='$pass' ";
    $select=mysqli_query($conn,$query);
     while ($row=mysqli_fetch_array($select)) {
        $a=$row['lastname'];
        $b=$row['password'];
        $c=$row['role'];
        $_SESSION['username']=$a;
        $_SESSION['password']=$b;
        $_SESSION['role']=$c;
        
        if ($user==$a and $pass==$b ) {

          if ($c=="admin") {
          header('location:manager/admin.php');
            # code...
          }elseif ($c=="orders") {
            header('location:Orders/orders.php');
            # code...
          }elseif ($c=="cashier") {
            # code..
            header('location:Cashiers/cashiers.php');
          }elseif ($c=="sales") {
            # code...
            header('location:Sales/sales.php');
          }elseif ($c=="production") {
            # code...
            header('location:Production/production.php');
          }elseif ($c=="psec") {
            # code...
            header('location:Psec/factory.php');
          }elseif ($c=="file") {
            # code...
            header('location:File/files.php');
          }elseif ($c=='delivery'){
            header('location:Delivering/delivery.php');
          }elseif($c=='accountant'){
            header('location:Accountant/accountant.php');
          }
         
        }else{
          $alertclass="alert alert-danger";
          $alertmess="Incorrect Username or Password";
        }

    }
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>RSM</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="icofont/icofont.min.css">
	<link rel="stylesheet" href="icofont/icofont.css">
</head>
<body class="bg-warning">
 <div class="container" >
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow p-1 bg-light border-bottom border-info">
 				<div class="well p-2">
 					<h3 class="display-4 font-weight-normal  text-info text-center " style="font-family: Quicksilver">RSM</h3>

 				</div>
 				<center><i><b>Rwanda special materials online system</b></i></p></center><p>
 			</div>
 		</div>

 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow-sm bg-white ">
 				&nbsp;<a href="index.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>Back</a>
 				<div class="row">
 					 <div class="col-md-4"></div>
 					 <div class="col-md-4"><br>
 					 	<!-- <h4 class="text-center font-italic font-weight-normal">administrator log in</h4> -->
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-4"></div>
 					<div class="col-md-4">
 						
 						<div class="well shadow-sm bg-light p-4  rounded border-top border-bottom border-info">
 							<!-- <h4 class="text-center font-weight-normal font-italic">Log In</h4> -->

 							<form method="post" action="" class="form-group">
 								<div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
 								<label>Lastname</label><br>
 								<input type="text" name="username" class="form-control" placeholder="Enter Your lastname" required ><br>
 								<label>Password</label><br>
 								<input type="password" name="password"id="myInput" class="form-control" placeholder="Enter Your Password" required><br>
 								​<input type="checkbox" onclick="myFunction()">Show Password
 								<div class="form-group form-check">
        </div>
 								<input type="submit" name="submit" class="btn btn-outline-info" value="Log In"> 
 									
 							</form>
 						</div>
 					</div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
 
</body>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</html>
