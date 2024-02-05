<?php
$pdf = new FPDF('L','mm','A4');	
$pdf->AddPage();
$pdf->SetFillColor(0,0,0);
$pdf->SetTitle($titulo);
$pdf->SetDisplayMode('fullpage', 'single');
$pdf->SetAutoPageBreak(1,1);
$pdf->Image('img/logo-absa.png', 15, 10,75);
$pdf->SetFont('helvetica','B',16);
$pdf->Ln(4);
$pdf->Cell(80);
$pdf->MultiCell(200,9,utf8_decode($cabezera),0,'C');
$pdf->Ln(1);
$pdf->Cell(260);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(45,7,date('d/m/Y'),0,1,'L',0);
$pdf->Ln(8);
	
