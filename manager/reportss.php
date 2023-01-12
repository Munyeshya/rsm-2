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


$petty=mysqli_query($conn,"SELECT sum(cash) as cash from petty where type='commissions' and  date BETWEEN '$sdate' and '$edate' ");
$sum=mysqli_fetch_array($petty);
$sum=$sum['cash'];

$petty2=mysqli_query($conn,"SELECT sum(cash) as cash from petty where type='other expenses' and  date BETWEEN '$sdate' and '$edate' ");
$sum1=mysqli_fetch_array($petty2);
$sum1=$sum1['cash'];

$left = mysqli_query($conn,"SELECT *  from money where date BETWEEN '$sdate' and '$edate' and reste!='0' ");
$left2 = mysqli_query($conn,"SELECT sum(reste) as pay1   from money where date BETWEEN '$sdate' and '$edate' and reste!='0'");



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

$pdf->Cell(130  ,5,'From: '.$sdate.' to '.$edate,0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
$pdf->SetFont('Arial','B',11);

//======================================================================
$viewer=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
$view=mysqli_fetch_array($viewer);
@$verify=$view['orderid'];

if (!empty($verify)) {
  // code...

$pdf->Cell(130  ,5,'PAID BY MTN Mobile money',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
while ($views=mysqli_fetch_array($query)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$views['orderid'],1,0);
$pdf->Cell(33,5,$views['date'] ,1,0);
$pdf->Cell(33,5,number_format($views['pay1']),1,1,'R');

}
$subquery=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
$now=mysqli_fetch_array($subquery);
$new=$now['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($new) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}elseif (empty($verify)) {

$pdf->Cell(130  ,5,'PAID BY MTN Mobile money',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
while ($views=mysqli_fetch_array($query)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$views['orderid'],1,0);
$pdf->Cell(33,5,$views['date'] ,1,0);
$pdf->Cell(33,5,number_format($views['pay1']),1,1,'R');

}
$subquery=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='MTN Mobile money' ");
$now=mysqli_fetch_array($subquery);
$new=$now['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,'0',1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}


//===========================================================
$viewer1=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
$view1=mysqli_fetch_array($viewer1);
@$verify1=$view1['orderid'];

if (!empty($verify1)) {
  // code...

$pdf->Cell(130  ,5,'PAID BY CASH',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query1=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
while ($fetch1=mysqli_fetch_array($query1)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch1['orderid'],1,0);
$pdf->Cell(33,5,$fetch1['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch1['pay1']),1,1,'R');

}
$subquery1=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
$now1=mysqli_fetch_array($subquery1);
$new1=$now1['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($new1) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}elseif (empty($verify1)) {
	$pdf->Cell(130  ,5,'PAID BY CASH',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query1=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
while ($fetch1=mysqli_fetch_array($query1)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch1['orderid'],1,0);
$pdf->Cell(33,5,$fetch1['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch1['pay1']),1,1,'R');

}
$subquery1=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='CASH' ");
$now1=mysqli_fetch_array($subquery1);
$new1=$now1['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,'0' ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}
//============================================================
$viewer2=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
$view2=mysqli_fetch_array($viewer2);
@$verify2=$view2['orderid'];

if (!empty($verify2)) {
  // code...

$pdf->Cell(130  ,5,'PAID BY BANK',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query2=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
while ($fetch2=mysqli_fetch_array($query2)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch2['orderid'],1,0);
$pdf->Cell(33,5,$fetch2['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch2['pay1']),1,1,'R');

}
$subquery2=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
$now2=mysqli_fetch_array($subquery2);
$new2=$now2['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($new2) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}elseif (empty($verify2)) {
	# code...
$pdf->Cell(130  ,5,'PAID BY BANK',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query2=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
while ($fetch2=mysqli_fetch_array($query2)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch2['orderid'],1,0);
$pdf->Cell(33,5,$fetch2['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch2['pay1']),1,1,'R');

}
$subquery2=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Bank' ");
$now2=mysqli_fetch_array($subquery2);
$new2=$now2['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,'0' ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}

//========================================================
$viewer3=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
$view3=mysqli_fetch_array($viewer3);
@$verify3=$view3['orderid'];

if (!empty($verify3)) {
  // code...

$pdf->Cell(130  ,5,'CHEQUE',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query3=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
while ($fetch3=mysqli_fetch_array($query3)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch3['orderid'],1,0);
$pdf->Cell(33,5,$fetch3['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch3['pay1']),1,1,'R');

}
$subquery3=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
$now3=mysqli_fetch_array($subquery3);
$new3=$now3['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($new3) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}elseif (empty($verify3)) {
	# code...
$pdf->Cell(130  ,5,'CHEQUE',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25,5,'OrderID',1,0);
$pdf->Cell(33,5,'DATE',1,0);
$pdf->Cell(33,5,'Amount',1,1,'R');
$query3=mysqli_query($conn,"SELECT  * from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
while ($fetch3=mysqli_fetch_array($query3)) {
$pdf->SetFont('Arial','',11);
$pdf->Cell(25,5,$fetch3['orderid'],1,0);
$pdf->Cell(33,5,$fetch3['date'] ,1,0);
$pdf->Cell(33,5,number_format($fetch3['pay1']),1,1,'R');

}
$subquery3=mysqli_query($conn,"SELECT  sum(pay1) as sum from moneyhist where date BETWEEN '$sdate' and '$edate' and method1='Cheque' ");
$now3=mysqli_fetch_array($subquery3);
$new3=$now3['sum'];

$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,'0' ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(189  ,10,'',0,1);//end of line
}

//Petty cashh=============================================

$pdf->SetFont('Arial','B',11);
$pdf->Cell(130  ,5,' ALL EXPENSES',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line


$pdf->SetFont('Arial','',11);

$pdf->Cell(45,5,'COMMISSION',1,0);
$pdf->Cell(45,5,number_format($sum),1,1,'R');
$pdf->Cell(45,5,'OTHER EXPENSES',1,0);
$pdf->Cell(45,5,number_format($sum1),1,1,'R');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(45,5,number_format($sum1+$sum),1,1,'R');
$pdf->SetTextColor(0, 0, 0);


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//=================================================================
$pdf->SetFont('Arial','B',11);

$pdf->Cell(130  ,5,' DEBTS',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25   ,5,'OrderID',1,0);
$pdf->Cell(33   ,5,'DATE',1,0);
$pdf->Cell(33   ,5,'Amount',1,1);//end of line
$pdf->SetFont('Arial','',11);
while ($refte=mysqli_fetch_array($left)) {

$pdf->Cell(25,5,$refte['orderid'],1,0);
$pdf->Cell(33,5,$refte['date'],1,0);
$pdf->Cell(33,5,number_format($refte['reste']),1,1,'R');


} 
$pdf->SetFont('Arial','B','12');
$reft=mysqli_fetch_array($left2);
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(33,5,number_format($reft['pay1']) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$for = mysqli_query($conn,"SELECT *  from deposits where date BETWEEN '$sdate' and '$edate' ");
$for2 = mysqli_query($conn,"SELECT sum(amount) as sum  from deposits where date BETWEEN '$sdate' and '$edate' ");
$fory=mysqli_fetch_array($for2);
$forty=$fory['sum'];
$pdf->Cell(130  ,5,'DEPOSITS',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(25   ,5,'Depositor',1,0);
$pdf->Cell(33   ,5,'Date',1,0);
$pdf->Cell(33   ,5,'Amount',1,1);//end of line

while ($fer=mysqli_fetch_array($for)) {


$pdf->SetFont('Arial','',11);



$pdf->Cell(25   ,5,$fer['depositor'],1,0);
$pdf->Cell(33   ,5,$fer['date'],1,0);
$pdf->Cell(33   ,5,$fer['amount'],1,1,'R');//end of line
}
$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($forty) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$for = mysqli_query($conn,"SELECT *  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$for2 = mysqli_query($conn,"SELECT sum(prev_amount) as sum  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$fory=mysqli_fetch_array($for2);
$forty=$fory['sum'];
$pdf->Cell(130  ,5,'STARTING BALACE',0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line

$pdf->Cell(33   ,5,'Origin',1,0);
$pdf->Cell(25   ,5,'Date',1,0);
$pdf->Cell(33   ,5,'Amount',1,1,'R');//end of line

while ($fer=mysqli_fetch_array($for)) {


$pdf->SetFont('Arial','',11);



$pdf->Cell(33   ,5,$fer['origin'],1,0);
$pdf->Cell(25   ,5,$fer['date'],1,0);
$pdf->Cell(33   ,5,$fer['prev_amount'],1,1,'R');//end of line
}
$pdf->SetFont('Arial','B','12');
$pdf->Cell(58,5,'TOTAL',1,0);
$pdf->SetTextColor(11, 102, 35);
$pdf->Cell(33,5,number_format($forty) ,1,1,'R');
$pdf->SetTextColor(0, 0, 0);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,10,'',0,1);//end of line
//=+=+=+=+=+=++++=+=+=++=+=+=++=++=+=++=++=++=++=++=++=++=++=++=+=+
$sums1 = mysqli_query($conn,"SELECT sum(amount) as sum  from deposits where date BETWEEN '$sdate' and '$edate' ");
$sumss = mysqli_fetch_array($sums1);
$fin=$sumss['sum'];

$sums2 = mysqli_query($conn,"SELECT sum(prev_amount) as sum  from prevbal where date BETWEEN '$sdate' and '$edate' ");
$sumss2 = mysqli_fetch_array($sums2);
$fin2=$sumss2['sum'];



$balance=$fin2+$new1-($sum1+$sum)-$fin;

$pdf->Cell(130  ,5,' BALANCE /'.$sdate.'-'.$edate,0,0);
$pdf->Cell(25   ,5,'',0,0);
$pdf->Cell(34   ,5,'',0,1);//end of line


$pdf->Cell(45.5,5,'AMOUNT',1,0);
$pdf->SetTextColor(11,102,35);
$pdf->Cell(45.5,5,number_format($balance),1,1,'R');





//summary
 // $pdf->Image('sign.png',160,250,50);


$pdf->Output();

?>
