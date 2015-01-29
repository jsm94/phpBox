<?php
session_start();
require_once '../global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/' . $_GET['carpeta'];
if($raizUsuario == $_SESSION['nick']){
    mkdir($carpeta,0777);
    echo "ok";
} else {
    die("0");
}
?>
