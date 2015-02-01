<?php
session_start();
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
if($raizUsuario == $_SESSION['nick']){
    if (!@mkdir($carpeta,0777)) {
        $error = error_get_last();
        echo $error['message'];
    } else {
        echo "ok";
    }
} else {
    die("0");
}
?>
