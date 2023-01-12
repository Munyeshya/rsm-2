<?php
include '../connection.php';
$id=$_GET['orderid'];

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

require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Image('header.png',1.95,0);
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line


$pdf->Cell(130  ,5,'',0,0);
$pdf->Cell(59   ,5,'Order ID: '.$id,0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130  ,5,"Names: ".$fname.' '.$lname,0,0);
$pdf->Cell(25   ,5,'RCVD: '.ucfirst($op),0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'Tel: '.$cont,0,0);
$pdf->Cell(25   ,5,'Tel: '.$contact,0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'Destination: '.$dest,0,0);
$pdf->Cell(25   ,5,ucfirst($fnam).' '.ucfirst($lnam),0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'Date: '.$date,0,0);
$pdf->Cell(25   ,5,ucfirst($n),0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line

while ($fetch=mysqli_fetch_array($bring)) {
    $a=$fetch['itemtype'];

$pdf->SetFont('Arial','B',12);

$pdf->Cell(12   ,5,$a,0,0);
$pdf->Cell(20   ,5,'',0,1);//end of line

$pdf->SetFont('Arial','',10);


$pdf->Cell(20   ,5,'SIZE',1,0);
$pdf->Cell(23   ,5,'PCS',1,0);
$pdf->Cell(20   ,5,'TS',1,0);
$pdf->Cell(23   ,5,'UP',1,0);
$pdf->Cell(26   ,5,'TP',1,1);//end of line

$list=mysqli_query($conn,"SELECT * from orders where orderid='$id' and itemtype='$a' ");
while ($row=mysqli_fetch_array($list)) {
    $tp=$row['TP'];

 $pdf->Cell(20   ,5,$row['size'],1,0);
 $pdf->Cell(23   ,5,$row['piece'],1,0);
 $pdf->Cell(20   ,5,$row['TS'],1,0);
 $pdf->Cell(23   ,5,'',1,0);
 $pdf->Cell(26   ,5,'',1,1);//end of line


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

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,0,'',0,1);//end of line

$pdf->SetFont('Arial','B',12);

$upii=mysqli_query($conn,"SELECT UP,TP from orders where orderid='$id' and itemtype='$a' order by id DESC LIMIT 1");
$fete=mysqli_fetch_array($upii);
$fin=$fete['UP'];
$fini=$fete['TP'];

$pdf->Cell(20   ,5,'TOT',1,0);
$pdf->Cell(23   ,5,round($sumupu1,4),1,0);
$pdf->Cell(20   ,5,round($sumupu,4),1,0);
$pdf->Cell(23   ,5,$fin,1,0);
$pdf->Cell(26   ,5,$fini,1,1);//end of line
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,5,'',0,1);//end of line
}

$gt=mysqli_query($conn,"SELECT GT FROM orders where orderid='$id' order by id DESC LIMIT 1 ");
$gtlist=mysqli_fetch_array($gt);
$gti=$gtlist['GT'];

$pdf->SetFont('Arial','B',12);


$pdf->Cell(12   ,5,"GRAND TOTAL:    ".number_format($gti)." FRW",0,0);
$pdf->Cell(20   ,5,'',0,1);//end of line



//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line

//invoice contents


//summary
 // $pdf->Image('sign.png',160,250,50);


$pdf->Output();
?>
