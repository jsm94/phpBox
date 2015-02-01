<?php
session_start();
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
$elementos = json_decode($_GET['elementos']);

// Funcion eliminar
function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}


if($raizUsuario == $_SESSION['nick']){
    foreach($elementos as $elemento){
        Delete($carpeta . $elemento);
    }
    echo "ok";
} else {
    die("0");
}
?>
