<?php
//ini_set('display_errors', 'On');
session_start();
header('Content-Type: application/json');
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
$elemento = $_GET['elemento'];


if($raizUsuario == $_SESSION['nick']){
    $array2 = array(
        'size', 'mtime'
      );
    $estado = lstat($carpeta . $elemento);
    $estado = array_intersect_key($estado, array_flip($array2));
    echo json_encode($estado);
} else {
    die("0");
}
?>
