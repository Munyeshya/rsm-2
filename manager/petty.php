<?php 
require_once('../session_helper.php');
if (isset($_SESSION['username'])) {
  # code...

$wel=$_SESSION['username'];
include '../connection.php';
$alertclass="";
$alertmess="";
if (isset($_POST['submit'])) {
    $names=$_POST['names'];
    $pup=$_POST['purpose'];
    $cash=$_POST['cash'];
    $date=date("Y/m/d");
    $typy=$_POST['type'];
    $query=mysqli_query($conn,"INSERT INTO petty values('$names','$pup','$cash','$date','$typy')");
    if ($query) {
        $alertmess="Record Successfull !!";
        $alertclass="alert alert-primary";
    }else{
        $alertmess="Record Unsuccessful !!";
        $alertclass="alert alert-danger";
    }
}
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
                    &nbsp;<a href="admin.php" style="text-decoration: none;" class="text-info"><i class="icofont-square-left"></i>&nbsp;Back</a>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="well shadow-sm bg-white p-2">
 				<div class="row">
 					 <div class="col-md-3">
                        <h4 class=" font-italic font-weight-normal"><a href="cashiers.php" class="text-info" style="text-decoration:none;"><i class="icofont-circled-left icofont-1x"></i></a></h4>
 					 </div>
 					 <div class="col-md-5"><br>
 					 	<h4 class="text-center font-italic font-weight-normal">Petty Cash:</h4>
 					 </div>
 				</div><br>

 				<div class="row">
 				<div class="col-md-4">
                    <form method="post" action="" class="form-control bg-light" style="height: auto;">
                         <div class="<?php echo $alertclass?>"><?php echo $alertmess?></div>
                        <LABEL>Petty type</LABEL>
<select class="form-control" name="type">
                        <option>Other expenses</option>
                    <option>commissions</option>

                </select>                             
                                <label >Names</label>
                                <input type="text" name="names" class="form-control" required>
                                <label >Purpose</label>
                                <input type="text" name="purpose" class="form-control" required>
                                <label >Cash</label>
                                <input type="text" name="cash" class="form-control" required>
                                <br>
<input type="submit" name="submit" class="btn btn-info btn-sm w-100" value="Submit"> 
                            </form>
 				</div>
                <div class="col-md-7">
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
   <img src="io.jpg" width="100%"> 
   <label><b>PETTY CASH REPORT</b></label><br>
<label><b><?php echo $wel?></b></label> <br>  
&nbsp;&nbsp;&nbsp;&nbsp;
    <table class="table table-bordered">
    <tr>
        <th>Names</th>
        <th>Purpose</th>
        <th>Cash</th>
        <th>Date</th>
        <th>Type</th>
    </tr>
   <?php
   if(isset($_POST['print'])){
       $edate=$_POST['edate'];
       $sdate=$_POST['sdate'];
       $query=$conn->query("SELECT * from petty where date BETWEEN '$sdate' and '$edate'  ");
       $bring = mysqli_query($conn,"SELECT *  from petty where date BETWEEN '$sdate' and '$edate' ");
       $bring2 = mysqli_query($conn,"SELECT sum(cash) as sum  from petty where date BETWEEN '$sdate' and '$edate' ");
       $view=mysqli_fetch_array($bring2);
       $show=$view['sum'];
       while($row=mysqli_fetch_array($query)){
   
   ?>
 <tr>
     <td><?php echo $row['names'] ?></td>
     <td><?php echo $row['purpose'] ?></td>
     <td><?php echo $row['cash'] ?></td>
     <td><?php echo $row['date'] ?></td>
     <td><?php echo $row['type'] ?></td>
 </tr>
<?php
}
}
?>

</table><br>

<b>TOTAL:&nbsp <label style="color:green" ><?php echo @$show ?>&nbsp<i>FRW</i></b> </label>
 <style>
 table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #000000;
  text-align: left;
  padding: 8px;
  border-top:1px solid black;
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
 				</div><br><br>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>

<?php
}else{
  header('location:../index.php');
}
?>