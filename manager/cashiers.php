<?php 
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$wel=$_SESSION['username'];
include '../connection.php';
$alertclass="";
$alertmess="";
$date=date("Y/m/d");
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
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p><a href="admin.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
 			<div class="well shadow-sm bg-white p-2">
 				<div class="row">
 					 <div class="col-md-8">
                        <h4 class=" font-italic font-weight-normal">
<a href="cashiers.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Refresh &nbsp<i class="icofont-refresh"></i></a>   
                            <a href="history.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">History <i class="icofont-search-document"></i></a>&nbsp<a href="petty.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Petty Cash<i class="icofont-bill-alt"></i></a>
<a href="deposits.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Deposits &nbsp<i class="icofont-bank"></i></a>
<a href="prevbal.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Starting Balance &nbsp<i class="icofont-money-bag"></i></a>
<a href="reports.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Reports &nbsp<i class="icofont-paper"></i></a>
<a href="debts.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Debts &nbsp<i></i></a>






                        </h4>
 					 	
 					 </div>
 				</div><br>
 				<div class="row">
 				<div class="col-md-8">
 					<form method="post">
                        <input type="text" name="sorder" class="form-control"   required="">
 				</div>
 				<div class="col-md-2">
                    <button type="submit" name="submit" class="btn btn-info"><i class="icofont-search"></i> Search order</button>
 					
 				</div>
            </form>
        </div>
        <div class="row">
 				<div class="col-md-9">
                    <Br><br>
                    <H1 style="font-size: 20px;">Id Number</H1>
                    <?php 
            include '../connection.php';
            if ( isset($_POST['sorder']) ) {
                $sorder=$_POST['sorder'];
                $query=mysqli_query($conn,"SELECT * from orders where vis='invisible' and orderid like '%$sorder%' and sales= is null ");
                $fetch=mysqli_fetch_array($query);
                @$result=$fetch['orderid'];
                if ( empty($result) ) {
                    echo "No results found";
               }

               
            ?>
                <div class="row">
              <div class="col-md-6">
            <p class="alert alert-warning"><?php echo $result ?></p>
            </div>
            <div class="col-md-2">
            <p class="alert alert-warning"><a href="approveone.php?id=<?php echo $result ?>"><i class="icofont-ui-next"></i></a></a> 
        </div>
       </div>
                <?php 
            }elseif(!isset($_POST['sorder'])){  
                $query=mysqli_query($conn,"SELECT DISTINCT(orderid)  from orders where vis='invisible' and sales is null ");
                while($fetch=mysqli_fetch_array($query)){
                $result=$fetch['orderid'];
            
            
                ?>

            <div class="row">
              <div class="col-md-6">
            <p class="alert alert-warning"><?php echo $result?></p>
            </div>
            <div class="col-md-2">
            <p class="alert alert-warning"><a href="approveone.php?id=<?php echo $result ?>"><i class="icofont-ui-next"></i></a></a> 
        </div>
       </div>
            <?php }}?>
 					
 				</div>
        <div class="row">

        	
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
