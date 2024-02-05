<?php
$pdf = new FPDF('P','mm','A4');	
$pdf->AddPage();
$pdf->SetFillColor(0,0,0);
$pdf->SetTitle($titulo);
$pdf->SetDisplayMode('fullpage', 'single');
$pdf->SetAutoPageBreak(1,1);
$pdf->Image('img/logo-fissa.png', 15, 10,40);
$pdf->SetFont('helvetica','B',16);
$pdf->Ln(5);
$pdf->Cell(22);
$pdf->Cell(190,7,$cabezera,0,1,'C',0);
$pdf->Ln(1);
$pdf->SetFont('helvetica','B',10);

?>
	
