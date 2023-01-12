<?php 
require_once ('../session_helper.php');
if ( isset($_SESSION['username'] )) {
  # code...

$name=$_SESSION['username'];

include '../connection.php';
$id=$_GET['orderid'];

$_SESSION['order']=$id;

$fish=mysqli_query($conn,"SELECT username from accounts where lastname='$name'");
$fis=mysqli_fetch_array($fish);
$fi=$fis['username'];

$all=mysqli_query($conn,"SELECT * from orders where orderid='$id'  ");
$fetch=mysqli_fetch_array($all);
$Client=$fetch['C_id'];
$dest=$fetch['destination'];
$date=$fetch['date'];
$n=$fetch['n'];
$com=$fetch['comid'];
$op=$fetch['operator'];

$operator=mysqli_query($conn,"SELECT * from accounts where lastname='$op' ");
$brc=mysqli_fetch_array($operator);
$contact=$brc['contact'];


$clientin=mysqli_query($conn,"SELECT * from clients where C_id='$Client' ");
$row=mysqli_fetch_array($clientin);
$fname=$row['firstname'];
$lname=$row['lastname'];
$cont=$row['client_contact'];

$comis=mysqli_query($conn,"SELECT * FROM commissioners where comid='$com' ");
$fet=mysqli_fetch_array($comis);
@$fnam=$fet['firstname'];
@$lnam=$fet['lastname'];

$bring = mysqli_query($conn,"SELECT *  from orders where UP!='' and orderid='$id' ");
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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
                        <a href="production.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
            </div>
        </div>
    </div>
 <!--   <div class="row"> -->
        <div class="col-md-12">
            <div class="well shadow-sm bg-white">
                <br>
                <div class="row">
                     <div class="col-md-12">
                        <h4 class="text-center font-italic font-weight-normal"><a href="filespeek.php?id=<?php echo $id?>" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a><a href="filehprint.php?orderid=<?php echo $id?>" class="text-info" style="text-decoration:none;">|<i class="icofont-refresh icofont-1x"></i></a></h4>
                        <div class="well shadow-sm bg-light p-3 rounded">
                            <h4 class="text-center font-weight-normal font-italic"></h4>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-8">
                           <button onclick="printDiv('pdf','Title')" class="btn btn-info col-md-8"><i class="icofont-printer icofont-1x"></i> &nbsp; Print</button>     
                           <br>
                         <div id="pdf" >
   <img src="io.jpg" width="900"> <br>
   <table style="margin-bottom:-300px">
       <b>
       <tr>
           <th style="font-family:Arial;  width:70%; border:none;">
           
            Names:<?php echo $fname." ".$lname ?><br>
            Contact:<?php echo $cont ?><br>
            Destination:<?php echo $dest ?><br>
            Date:<?php echo $date ?><br>
        </th>
        <th style="font-family:Arial;  width:30%; border:none;">
        <text style="color:skyblue;">OrderID:<?php echo $id?></text><br>
        RCVD: <?php echo $op?><br>
        Tel:<?php echo $contact?><br>
        Com: <?php echo $com?><br>
        <?php echo $n?><br>
</b>
       </tr>
        
   </table>
  <table class="table table-bordered table-responsive" style="width:70%;  ">
<?php
while ($fetch=mysqli_fetch_array($bring)) {
    $a=$fetch['itemtype'];
?>
<tr>
    <th colspan="5" style=" border:none;"><?php echo $a?></th>
</tr>
<tr>
    <th>SIZE</th>
    <th>PCS</th>
    <th>TS</th>
</tr>
<?php 
$list=mysqli_query($conn,"SELECT * from orders where orderid='$id' and itemtype='$a' ");
while ($row=mysqli_fetch_array($list)) {
?>
<tr>
    <td><?php echo $row['size']; ?></td>
    <td><?php echo $row['piece']; ?></td>
    <td><?php echo $row['TS']; ?></td>

</tr>


<br>
<?php 

}
$sumup=mysqli_query($conn,"SELECT SUM(TS) as tsum  from orders where orderid='$id' and itemtype='$a' ");
$sumu=mysqli_fetch_array($sumup);
$sumupu=$sumu['tsum'];

$sumup1=mysqli_query($conn,"SELECT SUM(piece) as tpcs  from orders where orderid='$id' and itemtype='$a' ");
$sumu1=mysqli_fetch_array($sumup1);
$sumupu1=$sumu1['tpcs'];

$miracle=mysqli_query($conn,"SELECT UP,TP FROM orders where orderid='$id' and end='end' ");
$mira=mysqli_fetch_array($miracle);
$up=$mira['UP'];
$tpp=$mira['TP'];

$upii=mysqli_query($conn,"SELECT UP,TP from orders where orderid='$id' and itemtype='$a' order by id DESC LIMIT 1");
$fete=mysqli_fetch_array($upii);
$fin=$fete['UP'];
$fini=$fete['TP'];
?>
<tr><b>
    <td>TOT</td>
    <td><?php echo $sumupu1?></td>
    <td><?php echo $sumupu?></td>
    </b>
</tr>
<tr>
    <td colspan="5" style="height:20px; border:none;"></td>
</tr>
<?php
}

?>



 <style>
 table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #000000;
  text-align: left;
  height
}

tr:nth-child(even) {
  background-color: #dddddd;
}

 </style>
</div>




<script>
var doc = new jsPDF();

 function saveDiv(divId, title) {
 doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
 doc.save('div.pdf');
}

function printDiv(divId,
  title) {

  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

  mywindow.document.write(`<html><head><title>${title}</title>`);
  mywindow.document.write('</head><body >');
  mywindow.document.write(document.getElementById(divId).innerHTML);
  mywindow.document.write('</body></html>');

  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  mywindow.close();

  return true;
}
</script>
                    </div>


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