<?php
include '../connection.php';

require_once('../session_helper.php');
if ($_SESSION['username']) {
  # code...
}else{
  header('location:../index.php');
}
$wel=$_SESSION['username'];
$date=date("Y/m/d");



$left = mysqli_query($conn,"SELECT *  from money where reste!='0' ");
$left2 = mysqli_query($conn,"SELECT sum(reste) as pay1   from money where reste!='0'");



require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

//$pdf->Image('header.png',1.95,0);
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line




//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);
$pdf->Image('header.png',6,-2,200);
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line

$pdf->Cell(130  ,5,'REPORT',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'BY: '.ucfirst($wel),0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'On: '.$date,0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->SetFont('Arial','B',11);

//=================================================================
$pdf->SetFont('Arial','B',11);

$pdf->Cell(130  ,5,' DEBTS',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(75   ,5,'Names',1,0);
$pdf->Cell(25   ,5,'OrderID',1,0);
$pdf->Cell(33   ,5,'DATE',1,0);
$pdf->Cell(33   ,5,'Amount',1,1);//end of line
$pdf->SetFont('Arial','',11);
while ($refte=mysqli_fetch_array($left)) {


$pdf->Cell(75   ,5,$refte['names'],1,0);
$pdf->Cell(25,5,$refte['orderid'],1,0);
$pdf->Cell(33,5,$refte['date'],1,0);
$pdf->Cell(33,5,number_format($refte['reste']),1,1,'R');


} 
$pdf->SetFont('Arial','B','12');
$reft=mysqli_fetch_array($left2);
$pdf->Cell(133,5,'TOTAL',1,0);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(33,5,number_format($reft['pay1']) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




//summary
 // $pdf->Image('sign.png',160,250,50);


$pdf->Output();

?>
