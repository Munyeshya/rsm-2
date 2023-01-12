<?php
include '../connection.php';

require_once('../session_helper.php');
if ($_SESSION['username'] and $_SESSION['sdate'] and $_SESSION['edate']) {
  # code...
}else{
  header('location:../index.php');
}
$wel=$_SESSION['username'];
$sdate=$_SESSION['sdate'];
$edate=$_SESSION['edate'];


$bring = mysqli_query($conn,"SELECT *  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$bring2 = mysqli_query($conn,"SELECT sum(prev_amount) as sum  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$view=mysqli_fetch_array($bring2);
$show=$view['sum'];

require('../manager/fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image('header.png',11,-2,200);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->Cell(189  ,10,'',0,1);//end of line




//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130  ,5,'DEPOSITS REPORT',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'BY: '.ucfirst($wel),0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'From: '.$sdate.' to '.$edate,0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line

$pdf->Cell(30   ,5,'Origin',1,0);
$pdf->Cell(30   ,5,'Date',1,0);
$pdf->Cell(40   ,5,'Amount',1,1);//end of line

while ($fetch=mysqli_fetch_array($bring)) {


$pdf->SetFont('Arial','',10);



$pdf->Cell(30   ,5,$fetch['origin'],1,0);
$pdf->Cell(30   ,5,$fetch['date'],1,0);
$pdf->Cell(40   ,5,$fetch['prev_amount'],1,1);//end of line
}
$pdf->Cell(189  ,5,'',0,1);//end of line
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(130  ,5,'TOTAL: '.number_format($show)."FRW",0,0);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line



//invoice contents


//summary
 // $pdf->Image('sign.png',160,250,50);


$pdf->Output();

?>
