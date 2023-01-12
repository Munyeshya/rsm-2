<?php 
include '../connection.php';
require_once('../session_helper.php');
if (isset($_SESSION['username']) and isset($_SESSION['month'])) {
  # code...
  
$name=$_SESSION['username'];
$id=$_GET['id'];
$year=date("Y");
$month=$_SESSION['month'];


$comis=mysqli_query($conn,"SELECT * FROM commissioners where comid='$id' ");
$fet=mysqli_fetch_array($comis);
@$fnam=$fet['firstname'];
@$lnam=$fet['lastname'];
@$ccontact=$fet['contact'];

$bring = mysqli_query($conn,"SELECT DISTINCT(orderid)  from orders where comid='$id' and date between '$year-$month-01' and '$year-$month-31'");

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
                        <h4 class="text-center font-italic font-weight-normal"><a href="Months/jan.php?id=<?php echo $id ?>" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a><a href="printcom.php?id=<?php echo $id?>" class="text-info" style="text-decoration:none;">|<i class="icofont-refresh icofont-1x"></i></a></h4>
                        <div class="well shadow-sm bg-light p-3 rounded">
                            <h4 class="text-center font-weight-normal font-italic"></h4>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-8">
                           <button onclick="printDiv('pdf','Title')" class="btn btn-info col-md-8"><i class="icofont-printer icofont-1x"></i> &nbsp; Print</button>     
                           <br>
                         <div id="pdf" >
   <img src="io.jpg" width="900"> <br>
   <table style="margin-bottom:20px">
       <b>
       <tr>
           <th style="font-family:Arial;  width:70%; border:none;">
           
           
        Names: <?php echo ucfirst($fnam).' '.ucfirst($lnam)?><br>
        <!--Tel:<?php echo $ccontact?><br>-->
        Date: <?php echo $year."/".$month?><br>
</b>
        </th>
        <th style="font-family:Arial;  width:30%; border:none;">
       
       </tr>
        
   </table>
  <table class="table table-bordered table-responsive" style="width:70%;  ">
      <tr>
    <th>SIZE</th>
    <th>PCS</th>
    <th>TS</th>
<tr>
<?php
while ($fetch=mysqli_fetch_array($bring)) {
    $a=$fetch['orderid'];
    
$list=mysqli_query($conn,"SELECT sum(TS) as sum,date from orders where date between '$year-$month-01' and '$year-$month-31' and orderid='$a' and comid='$id' GROUP BY date ");

while ($row=mysqli_fetch_array($list)) {

?>
<tr>
    <td><?php echo $a?></td>
    <td><?php echo $row['date']?></td>
    <td><?php echo $row['sum']?></td>
</tr>
<?php
}
    
}
$q1=mysqli_query($conn,"SELECT sum(TS) as sum from orders where date between '$year-$month-01' and '$year-$month-31' and comid='$id' ");
$f1=mysqli_fetch_array($q1);
$r1=$f1['sum'];
?>
<tr style="font-style:bold ">
    <b>
    <td colspan="2">
      TOTAL 
    </td>
    <td><?php echo $r1 ?> </td>
    </b>
</tr>


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