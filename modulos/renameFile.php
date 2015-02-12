<?php
//ini_set('display_errors', 'On');
session_start();
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
$elemento = $_GET['elemento'];
$nombre = $_GET['nombre'];

if($raizUsuario == $_SESSION['nick']){
    if (file_exists($carpeta . $nombre)) {
        echo '2';
    } else {
        rename($carpeta . $elemento, $carpeta . $nombre);
        echo "1";
    }
} else {
    die("0");
}
?>
