<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

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
                <center><i><b>Rwanda special materials online system<i class="icofont-earth"></i></b></i></p></center><p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="<?php echo $alertclass; ?>"><?php echo $alertmess; ?></div>
            <div class="well shadow-sm bg-white p-2">
                <div class="row">
                     <div class="col-md-6">
                        <h4 class=" font-italic font-weight-normal"><a href="orders.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">Back &nbsp<i class="icofont-circled-left"></i></a>&nbsp<a href="histors.php" class="btn-info btn-sm" style="text-decoration:none; font-size:">History &nbsp<i class="icofont-search-document"></i></a></h4>
                        
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
            if (isset($_POST['sorder'])) {
                $sorder=$_POST['sorder'];
                $query=mysqli_query($conn,"SELECT * from orders where vis='invisible' and orderid like '%$sorder%' and n='n'  and operator='$wel' and viewn is null ");
                $fetch=mysqli_fetch_array($query);
                $result=$fetch['orderid'];
            ?>
                <div class="row">
              <div class="col-md-6">
            <p class="alert alert-warning"><?php echo $result?></p>
            </div>
            <div class="col-md-2">
            <p class="alert alert-warning"><a href="extra.php?id=<?php echo $result ?>"><i class="icofont-ui-next"></i></a></a> 
        </div>
       </div>
                <?php 
            }else{  
                $query=mysqli_query($conn,"SELECT DISTINCT(orderid)  from orders where vis='invisible' and n='n' and operator='$wel' and n_size is null and viewn is null ");
                while($fetch=mysqli_fetch_array($query)){
                $result=$fetch['orderid'];
            
            
                ?>

            <div class="row">
              <div class="col-md-6">
            <p class="alert alert-warning"><?php echo $result?></p>
            </div>
            <div class="col-md-2">
            <p class="alert alert-warning"><a href="extra.php?id=<?php echo $result ?>"><i class="icofont-ui-next"></i></a></a> 
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
<?php
}else{
  header('location:../index.php');
}
?>
