<?php  
require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$name=$_SESSION['username'];


$id=$_GET['orderid'];
include '../connection.php';
if (isset($_POST['print'])) {

  $sql=$conn->query("SELECT * FROM orders WHERE orderid='$id' ") or die(mysqli_error($conn));
   
   $mercury=mysqli_query($conn,"SELECT * from orders where orderid='$id' and end='end'");
   $mercur=mysqli_fetch_array($mercury);
   $mercu=$mercur['C_id'];
   $merc=$mercur['destination'];
   $mer=$mercur['date'];
   $op=ucfirst($mercur['operator']);
   $grand=$mercur['GT'];

   $other=mysqli_query($conn,"SELECT * from accounts where lastname='$op'");
   $othe=mysqli_fetch_array($other);
   $fname=ucfirst($othe['firstname']);
   $cont=$othe['contact'];

   $neptune=mysqli_query($conn,"SELECT * from clients where C_id='$mercu' ");
   $neptun=mysqli_fetch_array($neptune);
   $firstname=$neptun['firstname'];
   $lastname=$neptun['lastname'];
   $contact=$neptun['client_contact'];



$sting=<<<HEADER

</HEADER><table><tr><th style="padding-left: 190px;" ><h2 style="color:#2b8dba; font-family: Century Gothic; font-size: 20px;">Rwanda Special Materials</h2></th></tr></table>
<br>

<table><tr>
 <td>
<p>Names:$firstname $lastname</p>
 </td>
<td style="padding-left: 390px; color:green;"><p>Orderid:$id</p></td>
</tr>
<tr>
  <td>TEL:$contact</td> <td style="padding-left: 390px;"><p>$fname &nbsp;$op &nbsp;</p></td></tr>
<tr><td>DESTINATION:$merc</td><br>
  <td style="padding-left: 390px;"><p>$cont </p></td>
</tr>
<tr>
<td> 
DATE: $mer <br>
</td>

</table>
<br>
<table style="border-collapse: collapse; width: 80%;" border="1">
<tr>
   <th>TYPE</th>
   <th>SIZE</th>
   <th>PIECE</th>
   <th>TS</th>
   <th>UP</th>
   <th>TP</th>
   <th>GT</th>
</tr> </html>
HEADER;
while ($row=mysqli_fetch_array($sql)) {
  $type=$row['itemtype'] ;
$size=$row['size'];
$piece=$row['piece'];
$ts=$row['TS'];
$up=$row['UP'];
$tp=$row['TP'];
 $sting .="<tr>
    <td>".$type."</td>
    <td>".$size."</td>
    <td>".$piece."</td>
    <td>".$ts."</td>
    <td>".$up."</td>
    <td>".$tp."</td>
    <td></td>
</tr>
 ";
}
$sting.="<tr>
<td>TOTAL</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>".$grand."</td>
</tr>
";
 $sting .="</table>";

 //echo $sting, die();
 require_once 'vendor/autoload.php';

 $pdf= new Mpdf\Mpdf();

 $pdf->Open();

 $pdf->AddPage("P");

 $pdf->SetFont("Century Gothic","N",13);

 $pdf->WriteHTML($sting);

 $pdf->Output();
 die;
}
?>