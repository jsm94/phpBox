<?php
ini_set('display_errors', 'On');
session_start();
include_once '../global.php';
//include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario;
$espacio = 0;
$archivos = array();
// Funcion para devolver los megas
function human_filesize($bytes, $decimals = 2) {
	$sz = 'BKMGTP';
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}


// START Creamos un iterador recursivo por las carpetas del usuario
// initialize an iterator
// pass it the directory to be processed
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($carpeta));
//$zip->addEmptyDir($elemento);
// iterate over the directory
// add each file found to the archive
foreach ($iterator as $key=>$value) {
	if(substr($key,-1) !== '.'){
		$espacio += filesize($key);
		array_push($archivos, str_replace($BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/',"",$key));
	}
}
$espacio = human_filesize($espacio);
//$archivos = array_diff($archivos, array('..', '.', '.tmp*', '.pdf*', '.backups*', '.informes*'));
// END Iterador


require 'fpdf/fpdf.php';
require 'fpdf/addons.php';
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(73,81,181);
$pdf->Cell(0,10,'phpBox',0,1,'C');
$pdf->SetFont('Arial','',16);
$pdf->SetTextColor(60,60,60);
$pdf->Cell(40,30,'Informe de: ',0,0,'R');
$pdf->SetFont('Arial','UB',16);
$pdf->SetDrawColor(73,81,181);
$pdf->SetTextColor(115,115,115);
$pdf->Cell(0,30,$raizUsuario);
$pdf->Line(15, 45, 210-15, 45);
$pdf->SetFillColor(0, 119, 26);
$pdf->Circle(105, 80, 25, 'F');
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(0,60,$espacio,0,0,"C");
$pdf->Ln(40);
$pdf->SetTextColor(60,60,60);
$pdf->Cell(0,60,'ocupado en disco',0,0,"C");
$pdf->Ln(20);
$pdf->Cell(0,30,'',0,1);
$txt = "";
foreach ($archivos as $key => $value) {
	if($key > 0 && $key < sizeof($archivos))
		$txt .= ",";

	$txt .= " " . $value;
}
$pdf->SetFont('Arial','B',14);
$pdf->SetFillColor(145, 173, 163);
$pdf->SetTextColor(0, 119, 26);
$pdf->SetDrawColor(0, 119, 26);
$pdf->Cell(0,10,'Archivos',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(70,70,70);
$pdf->Write(10,$txt);
$pdf->Output();