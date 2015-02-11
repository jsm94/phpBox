<?php
ini_set('display_errors', 'On');
session_start();
include_once '../global.php';
//include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.informes';
require 'fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Hecho con FPDF.',0,1,'C');
$pdf->Cell(40,30,'Informe de: ',0,0,'R');
$pdf->SetFont('Arial','U',16);
$pdf->Cell(0,30,$raizUsuario);
$pdf->Output();
