<?php

$this->load->library('pdf');
$pdf = new Pdf('P','mm','Letter');
	
$pdf->Open();
$pdf->SetMargins(15, 10, 10);
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');



$cont=0; 

//cabezera de columnas
$pdf->setFont('times', 'B', 12);
$pdf->Cell(10, 5, '#' , 1, 0, 'R');	
$pdf->Cell(20, 5, 'ID', 1, 0, 'R');
$pdf->Cell(50, 5, 'NOMBRE', 1, 0);	
$pdf->Cell(50, 5, 'DESCRIPCION', 1, 1);
	
$pdf->setFont('times', '', 12);
foreach ($Grupos->result() as $Grupo){
	$cont++;
	
	$pdf->Cell(10, 5, $cont , 1, 0, 'R');	
	$pdf->Cell(20, 5, $Grupo->id, 1, 0, 'R');
	$pdf->Cell(50, 5, $Grupo->name, 1, 0);	
	$pdf->Cell(50, 5, $Grupo->description, 1, 1);
}

$pdf->Output('grupos.pdf', 'D');
?>