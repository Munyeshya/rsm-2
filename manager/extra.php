<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

$name=$_SESSION['username'];
$alertmess="";
$alertclass="";
include '../connection.php';
$id=$_GET['id'];

$select=mysqli_query($conn,"SELECT * from orders where orderid='$id'");
$fetch=mysqli_fetch_array($select);
$clid=$fetch['C_id'];
$op=$fetch['operator'];
$item=$fetch['itemtype'];
$destin=$fetch['destination'];
$date=$fetch['date'];
$up=$fetch['UP'];
$sz=$fetch['size'];
$pc=$fetch['piece'];
$tots=$fetch['TS'];


$getc=mysqli_query($conn,"SELECT * from clients where C_id ='$clid'");
$getcli=mysqli_fetch_array($getc);
$cfname=$getcli['firstname'];
$clname=$getcli['lastname'];
$ccontact=$getcli['client_contact'];

if (isset($_POST['post'])) {
  $tpe=$_POST['type'];
  $reduce=$_POST['minus'];
$select=mysqli_query($conn,"SELECT id,size,piece from orders where itemtype='$tpe' and orderid='$id' ");
while ($fet=mysqli_fetch_array($select)) {
  $i=$fet['id'];
  $ize=$fet['size'];
  $ice=$fet['piece'];
$newsize=$ize-$reduce;
$newsum=$newsize*$ice;
$masterquery=mysqli_query($conn,"UPDATE orders set n_size='$newsize' where itemtype='$tpe' and id='$i'  ");
$masterquery2=mysqli_query($conn,"UPDATE orders set tsn='$newsum' where itemtype='$tpe' and id='$i' ");   
}
$secondquery=mysqli_query($conn,"UPDATE orders SET viewn='yes' where orderid='$id' ");
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
 	<!-- <div class="row"> -->
 	<div class="col-md-12">
 			<div class="well shadow p-1 bg-light border-bottom border-info">
 				<div class="well p-1">
 					<h3 class="display-4 font-weight-normal  text-info text-center " style="font-family: Quicksilver">RSM</h3>

 				</div>
 				<center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
 						&nbsp;
 			</div>
 		</div>
 	</div>
 <!-- 	<div class="row"> -->
 		<div class="col-md-12">
 			<div class="well shadow-sm bg-white">
 				<br>
 				<div class="row">
 					 <div class="col-md-12">
 					 	<h4 class="text-center font-italic font-weight-normal"><a href="all.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a><a href="extra.php?id=<?php echo $eid?>" class="text-info" style="text-decoration:none;">|<i class="icofont-refresh icofont-1x"></i></a></h4>
 					 	<div class="well shadow-sm bg-light p-3 rounded">
                            <div class="alert alert-primary" style="text-align: center;"><i class="icofont-ui-user"></i> <?php echo ucwords($name) ?>    &nbsp |Create An Order</div>
 							<h4 class="text-center font-weight-normal font-italic"></h4>
 							<div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
 								<div class="row">
 									
 <div class="col-md-8">

 	<table class="table table-bordered table-responsive" style="font-size:13px">
    <form method="post" action="extra.php?id=<?php echo $id?>">
    <tr>
      <th colspan="6">
        <select name="type" class="form-control">
          <?php 
          $bring = mysqli_query($conn,"SELECT itemtype  from orders where UP!='' and orderid='$id' ");
          while ($fetch=mysqli_fetch_array($bring)) {
            $type=$fetch['itemtype'];

          ?>
          <option value="<?php echo $type  ?>"><?php echo $type ?></option>
        <?php }?>
        </select>
      </th>
      <th colspan="2">
        <input type="text" name="minus" class="form-control" style="width: 80px">
      </th>
      <th>
        <input type="submit" name="post" class="btn btn-sm btn-info">
      </th>
    </tr>
  </form>
 		<tr>

 			<th colspan="6">
 			
 				Name:<?php echo $cfname."&nbsp".$clname ?><br>
 				Contact:<?php echo $ccontact; ?>
 			</th>
 			<th colspan="4">
 				ORDER ID:
       <?php 
       echo $id;
       $id ?>
 			</th>			
 			
 		</tr>
 		<tr>
 			<th>Type</th>
 			<th>UP</th>
 			<th>Size</th>
 			<th>E size</th>
 			<th>Piece</th>
 			<th>TS</th>
 			<th>TP</th>
 			<th colspan="2">GT</th>	
 			
 		</tr>
 		<?php 
        include '../connection.php';
        $ex=mysqli_query($conn,"SELECT * from orders where orderid='$id' ");

        while($res=mysqli_fetch_array($ex)){
        	$oid=$res['id'];
        	$nsiize=$res['n_size'];
        	$npiiece=$res['n_piece'];

        
 		?>
 		<tr>
 			<th><?php echo $res['itemtype']?> </th>
 			<th><?php echo $res['UP']?> </th>
 			<th><?php echo $res['size']?> </th>
 			<th><?php echo $res['n_size']?> </th>
 			<th><?php echo $res['piece']?> </th>
 			<th><?php $ts=$res['size']*$res['piece']; echo $ts ?> </th>
 			<th><?php echo $res['TP']?></th>
 			<th><?php echo $res['GT']?></th>
      <th colspan="2"></th>
 			
 			<?php
     }
 			?>

 		</tr>
 	</table>
 </div>		
 </div>					
 					</div>
 				</div><br>
 				
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
    border-radius: 7px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
</style>
<?php 
}else{
  header('location:../index.php');
}
?>