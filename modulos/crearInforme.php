<?php
ini_set('display_errors', 'On');
session_start();
if($_GET['usuario'] !== $_SESSION['nick'])
    die('0');
include_once '../global.php';
//include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario;
$fecha = date('d-m-Y_H-i-s');
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

/*
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
$pdf->Cell(0,30,'',0,1);*/
$txt = "";
foreach ($archivos as $key => $value) {
    if($key > 0 && $key < sizeof($archivos))
        $txt .= ",";

    $txt .= " " . $value;
}/*
$pdf->SetFont('Arial','B',14);
$pdf->SetFillColor(145, 173, 163);
$pdf->SetTextColor(0, 119, 26);
$pdf->SetDrawColor(0, 119, 26);
$pdf->Cell(0,10,'Archivos',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(70,70,70);
$pdf->Write(10,$txt);
$pdf->Output();
*/
require 'mpdf/mpdf.php';
$stylesheet = file_get_contents('mpdf/style.css'); // Añadimos hoja de estilos
$mpdf = new mPDF('','', 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->SetHTMLHeader('<div class="cabecera"><h1 style="font-family: Roboto">phpBox</h1></div>');
$mpdf->WriteHTML('<div class="canvas">');
$mpdf->WriteHTML('<h2 style="font-family: Roboto">Informe de:  &nbsp;<span class="gray">' . $raizUsuario . '</span></h2>');
$mpdf->WriteHTML('<div class="line"><div>');
$mpdf->WriteHTML('<div style="margin-left:37%;margin-top:40px" class="circle"><p style="font-family: Roboto" class="size">' . $espacio . '</p><div>');
$mpdf->WriteHTML('<p style="font-family: Roboto" class="textL">- de almacenamiento ocupado -</p>');
$mpdf->WriteHTML('<h2 style="font-family: Roboto;padding-top:20px">Archivos alojados</h2>');
$mpdf->WriteHTML('<div class="line"><div>');
$mpdf->WriteHTML('<p style="padding-left:50px;padding-right:50px;text-align:justify;text-justify: inter-word;line-height: 200%;font-family: Roboto">' . $txt . '</p>');
$mpdf->WriteHTML('</div>');
$mpdf->Output($carpeta . '/.informes/informe-' . $fecha . '.pdf','F');
printf('1');
