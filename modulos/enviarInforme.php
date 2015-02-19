<?php
//ini_set('display_errors', 'On');
session_start();
require("PHPMailer/PHPMailerAutoload.php");
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$informe = $_GET['informe'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.informes/';
$imagen = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.tmp/' . $_GET['imagen'];

if($raizUsuario == $_SESSION['nick']){

    if($_GET['imagen'] !== ''){
        // Añadimos la imagen al pdf
        require 'mpdf/mpdf.php';

        $mpdf = new mPDF();
        $mpdf->SetImportUse();

        $mpdf->SetDocTemplate($carpeta . $informe,true);

// Do not add page until doc template set, as it is inserted at the start of each page
        $mpdf->AddPage();

// Subsequent pages from logoheader.pdf will be inserted on all subsequent pages
        $mpdf->SetAlpha(0.2);
        $mpdf->Image($imagen,0,0,210,297,'jpg','',true, false);
        $mpdf->SetAlpha(1);
        $mpdf->Output($carpeta . $informe,'F');
    }

    // Borramos todos los elementos de la carpeta temporal
    $tmpDir = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.tmp';
    $files = array_diff(scandir($tmpDir), array('.','..'));
    foreach ($files as $file) {
        unlink("$tmpDir/$file");
    }

    // PHPMailer
    $userMail = $_SESSION['email'];
    $mail = new PHPMailer();
//indico a la clase que use SMTP
    $mail->IsSMTP();
//permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
//Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
//indico el servidor de Gmail para SMTP
    $mail->Host = "smtp.gmail.com";
//indico el puerto que usa Gmail
    $mail->Port = 465;
//indico un usuario / clave de un usuario de gmail
    $mail->Username = "jsm.noreply@gmail.com";
    $mail->Password = "noreply1234";
    $mail->SetFrom('jsm.noreply@gmail.com', 'phpBox');
    //$mail->AddReplyTo("tu_correo_electronico_gmail@gmail.com","Nombre completo");
    $mail->Subject = "Informe de su nube - phpBox";
    $mail->MsgHTML("Se le adjunta el informe en este correo.");
    $mail->AddAttachment($carpeta . $informe);
//indico destinatario
    $address = $userMail;
    $mail->AddAddress($address, "");
    if(!$mail->Send()) {
        echo "2";
    } else {
        echo "1";
    }
} else {
    die("0");
}
?>
