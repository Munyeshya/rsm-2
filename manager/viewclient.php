<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

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
<body class="bg-warning">
 <div class="container"><br>
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
 			<div class="well shadow-sm bg-white">
 				<div class="row">
 					 <div class="col-md-4"></div>
 					 <div class="col-md-4"><br>
 					 	<h4 class="text-center font-italic font-weight-normal">View Clients:</h4>
 					 </div>
 				</div><br>
 				<div class="row">
 					<div class="col-md-12">
 						<div class="well shadow-sm p-2">
                        <div class="row">
                        	<div class="col-md-1">
                        		<h4 class=" font-italic font-weight-normal"><a href="orders.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a><a href="viewclient.php" class="text-info" style="text-decoration:none;"><i class="icofont-refresh icofont-1x"></i></a></h4>
                        	</div>
	                        <div class="col-md-9">
		                        <form method="post" class="form-group">
 							 	<input type="text" name="search" class="form-control" required>
	                        </div>
	                        <div class="col-md-2">
	                        	<button type="submit" name="result" class=" btn btn-warning">Search<i class="icofont-search"></i></button>
 							 </form>
	                        </div>
 							</div>
 							<?php
 							include '../connection.php';
 							if (isset($_POST['result'])) {
 								$index=$_POST['search'];
 								$query=mysqli_query($conn,"SELECT * FROM clients WHERE firstname like '%$index%' OR lastname like'%$index%' OR client_contact LIKE '%$index%'");
 								while ($row=mysqli_fetch_array($query)) {
 									?>
 							<p class="alert alert-warning">
 							 		
 							 			
 							 				Client Names: <?php echo $row['firstname']."&nbsp".$row['lastname']; ?><br>
 							 				Clien contact: <?php echo $row['client_contact']; ?>
 							 			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 							 			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 							 			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 							 			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 							 				<a href="ordering.php?id=<?php echo $row['C_id']; ?>" style="text-decoration: none;"  class="text-success">Action<i class="icofont-ui-edit" title="Delete"></i></a>
 							 				

 							 			
 							 		
 							 	</p>

 							 <?php
 							}
 								include '../connection.php';
 							}else{
 								$query=mysqli_query($conn,"SELECT * FROM clients where firstname !='' ");
 								while ($row=mysqli_fetch_array($query)) {
 						
 						?>
 						<div class="alert alert-warning">
 							 		<div class="row">
 							 			<div class="col-md-8">
 							 				Client Names: <?php echo $row['firstname']."&nbsp".$row['lastname']; ?><br>
 							 				Client contact: <?php echo $row['client_contact']; ?>
 							 			</div>
 							 			
 							 			<div class="col-md-4">
 							 				<a href="ordering.php?id=<?php echo $row['C_id']; ?>" style="text-decoration: none;"  class="text-success">Action<i class="icofont-ui-edit" title="Delete"></i></a>
 							 				
 							 			</div>
 							 		</div>
 							 	</div>
 							 	 <?php 
 					}}
 					?>
                              
 						</div>
 					</div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>
<style type="text/css">
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
</style>
<?php
}else{
  header('location:../index.php');
} 
?>