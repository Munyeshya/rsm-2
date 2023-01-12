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
 						&nbsp;<a href="cashiers.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow-sm bg-white">
 				<br>
 				<div class="row">
 					<div class="col-md-2"></div>
 					 <div class="col-md-8">

 				<div class="well shadow-sm bg-light p-3 rounded">
 							<h4 class="text-center font-weight-normal font-italic">
                            Debts Report</h4>
                            <br>
 							 <button onclick="printDiv('pdf','Title')" class="btn btn-info col-md-8"><i class="icofont-printer icofont-1x"></i> &nbsp; Print</button>     
                           <br>
                         <div id="pdf" >
   <img src="io.jpg" width="900"> <br>
   <table style="margin-bottom:-50px">
       <b>
       <tr>
        <th style="font-family:Arial;  width:30%; border:none;">
        DEBTS REPORT <br>BY:<?php echo $wel?><br>    
      </b>
    </th>   
    </tr>
        
   </table>
  <table class="table table-bordered table-responsive" style="width:70%;  ">
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>
<tr>
    <th>Names</th>
    <th>OrderID</th>
    <th>Date</th>
    <th>Reste</th>
</tr>
<?php 
$left = mysqli_query($conn,"SELECT *  from money where reste!='0' ");
$left2 = mysqli_query($conn,"SELECT sum(reste) as pay1   from money where reste!='0'");

while ($row=mysqli_fetch_array($left)) {
?>
<tr>
    <td><?php echo $row['names']; ?></td>
    <td><?php echo $row['orderid']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo number_format($row['reste']); ?></td>
</tr>
<?php 
}
?>

<tr>
    <td colspan="3">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td><b><?php $reft=mysqli_fetch_array($left2); echo number_format($reft['pay1'])." FRW" ?> </b></td>
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
 					 <div class="col-md-2"></div>
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>