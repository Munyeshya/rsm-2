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
if(isset($_POST['print'])){
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];
    $_SESSION['sdate']=$sdate;
    $_SESSION['edate']=$edate;
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
<table class=" table table-bordered table  table-responsive " style="font-size:13px; width:100%; ">
                        <tr class="table-borderless">
                            <th>
                                <form method="post">
                                        
                                            <input type="date" name="sdate" class="form-control" required>
                                        </th>
                                        <th>
                                            <input type="date" name="edate" class="form-control" required>
                                        </th>
                                       
                        </tr>
                        <tr class="table-borderless">
                            <th >
                             <button type="submit" name="print" class="btn btn-info btn-sm w-100"><i class="icofont-printer"></i>&nbsp;View Report</button>
                                        </form>
                                        </th>
                                         <th >
                            <button onclick="printDiv('pdf','Title')" class="btn btn-info btn-sm w-100"><i class="icofont-printer" ></i>&nbsp;Print Report</button>
                                        </form>
                                        </th>
                        </tr>
                        </table>

                         <div id="pdf" >
   <img src="io.jpg" width="900"> <br>
   <table style="margin-bottom:-50px">
       <b>
       <tr>
        <th style="font-family:Arial;  width:30%; border:none;">
        REPORT <br>BY:<?php echo $wel?><br>    
      </b>
    </th>   
    </tr>
        
   </table>
  <table class="table table-bordered table-responsive" style="width:70%;  ">
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>
<?php 
if(isset($_POST['print'])){
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];
    $_SESSION['sdate']=$sdate;
    $_SESSION['edate']=$edate;

?>
<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">PAID BY MTN Mobile Money</td>
</tr>
<tr>
    <th>OrderID</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$left=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");

$subquery=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
$now=mysqli_fetch_array($subquery);
$new=$now['sum'];

while ($row=mysqli_fetch_array($left)) {
?>
<tr>
    <td><?php echo $row['orderid']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo number_format($row['pay1']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($new) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>


<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">PAID BY CASH</td>
</tr>
<tr>
    <th>OrderID</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$left1=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");

$subquery1=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
$now1=mysqli_fetch_array($subquery1);
$new1=$now1['sum'];

while ($row=mysqli_fetch_array($left1)) {
?>
<tr>
    <td><?php echo $row['orderid']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo number_format($row['pay1']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($new1) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>


<tr>
    <td colspan="4" style=" border:none; font-weight:bold " ">PAID BY BANK</td>
</tr>
<tr>
    <th>OrderID</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$left2=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");

$subquery2=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
$now2=mysqli_fetch_array($subquery2);
$new2=$now2['sum'];

while ($row=mysqli_fetch_array($left2)) {
?>
<tr>
    <td><?php echo $row['orderid']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo number_format($row['pay1']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($new2) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>

<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">PAID BY CHEQUE</td>
</tr>
<tr>
    <th>OrderID</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$left3=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");

$subquery3=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
$now3=mysqli_fetch_array($subquery3);
$new3=$now3['sum'];

while ($row=mysqli_fetch_array($left3)) {
?>
<tr>
    <td><?php echo $row['orderid']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo number_format($row['pay1']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($new3) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>



<tr>
    <td colspan="3" style=" border:none; font-weight:bold ">ALL EXPENSES</td>
</tr>
<?php 
$petty=mysqli_query($conn,"SELECT sum(cash) as cash from petty where type='commissions' and  date BETWEEN '$sdate' and '$edate' ");
$sum=mysqli_fetch_array($petty);
$sum=$sum['cash'];

$petty2=mysqli_query($conn,"SELECT sum(cash) as cash from petty where type='other expenses' and  date BETWEEN '$sdate' and '$edate' ");
$sum1=mysqli_fetch_array($petty2);
$sum1=$sum1['cash'];


?>
<tr>
    <td colspan="2">COMMISSIONS</td>
    <td><?php echo number_format($sum) ?></td>
</tr>
<tr>
    <td colspan="2">OTHER EXPENSES</td>
    <td><?php echo number_format($sum1) ?></td>
</tr>

<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>

    <td style="color:darkgreen; text align:right "><b><?php  echo number_format($sum+$sum1) ?> </b></td>
</tr>
<tr>
    <td colspan="3" style="height:40px; border:none;"></td>
</tr>

<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">DEBTS</td>
</tr>
<tr>
    <th>Names</th>
    <th>OrderID</th>
    <th>Amount</th>
</tr>
<?php 
$left4 = mysqli_query($conn,"SELECT *  from money where date BETWEEN '$sdate' and '$edate' and reste!='0' ");
$left5 = mysqli_query($conn,"SELECT sum(reste) as pay1   from money where date BETWEEN '$sdate' and '$edate' and reste!='0'");

while ($row=mysqli_fetch_array($left4)) {
?>
<tr>
    <td><?php echo @$row['names']; ?></td>
    <td><?php echo @$row['orderid']; ?></td>
    <td><?php echo number_format(@$row['reste']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkred;"><b><?php  $reft=mysqli_fetch_array($left5); echo number_format(@$reft['pay1'] ) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>

<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">DEPOSITS</td>
</tr>
<tr>
    <th>Depositor</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$for = mysqli_query($conn,"SELECT *  from deposits where date BETWEEN '$sdate' and '$edate' ");
$for2 = mysqli_query($conn,"SELECT sum(amount) as sum  from deposits where date BETWEEN '$sdate' and '$edate' ");
$fory=mysqli_fetch_array($for2);
$forty=$fory['sum'];

while ($fer=mysqli_fetch_array($for)) {
?>
<tr>
    <td><?php echo $fer['depositor']; ?></td>
    <td><?php echo $fer['date']; ?></td>
    <td><?php echo number_format($fer['amount']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($forty) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>



<tr>
    <td colspan="4" style=" border:none; font-weight:bold ">STARTING BALANCE</td>
</tr>
<tr>
    <th>Origin</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php 
$fo = mysqli_query($conn,"SELECT *  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$f = mysqli_query($conn,"SELECT sum(prev_amount) as sum  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$fy=mysqli_fetch_array($f);
$fty=$fy['sum'];

while ($fer=mysqli_fetch_array($fo)) {
?>
<tr>
    <td><?php echo $fer['origin']; ?></td>
    <td><?php echo $fer['date']; ?></td>
    <td><?php echo number_format($fer['prev_amount']); ?></td>
</tr>
<?php 
}
?>
<tr>
    <td colspan="2">
        <text>
            <b>TOTAL: </b>
        </text>
    </td>
    <td style="color:darkgreen;"><b><?php  echo number_format($fty) ?> </b></td>
</tr>
<tr>
    <td colspan="4" style="height:40px; border:none;"></td>
</tr>
<?php
$sums1 = mysqli_query($conn,"SELECT sum(amount) as sum  from deposits where date BETWEEN '$sdate' and '$edate' ");
$sumss = mysqli_fetch_array($sums1);
$fin=$sumss['sum'];

$sums2 = mysqli_query($conn,"SELECT sum(prev_amount) as sum  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$sumss2 = mysqli_fetch_array($sums2);
$fin2=$sumss2['sum'];

$balance=(($new1+$fin2)-($fin+$sum+$sum1));
?>
<tr>
    <td colspan="2"  style="border:none;">
        <text>
            <b>BALANCE: </b>
        </text>
    </td>
    <td style="color:darkgreen; border:none; "><b><?php  echo number_format($balance) ."  FRW"?> </b></td>
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
<?php } ?>