<?php
session_start();
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
$elementos = json_decode($_GET['elementos']);
$fecha = date('d-m-Y_H-i-s');
$bk = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.backups/backup-'. $fecha .'.zip';

if($raizUsuario == $_SESSION['nick']){
    // create object
    $zip = new ZipArchive();

    // open archive
    if ($zip->open($bk, ZIPARCHIVE::CREATE) !== TRUE) {
        die ("Could not open archive");
    }

    foreach($elementos as $elemento){
        if(is_dir($carpeta . $elemento)){
            // initialize an iterator
            // pass it the directory to be processed
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($carpeta . $elemento));
            //$zip->addEmptyDir($elemento);
            // iterate over the directory
            // add each file found to the archive
            foreach ($iterator as $key=>$value) {
                if(substr($key,-1) !== '.')
                    $zip->addFile(realpath($key), str_replace($BOX_RAIZ . $BOX_prefixUser . $raizUsuario,"",$key)) or die ("ERROR: Could not add file: $key");
            }
        } else {
            $zip->addFile($carpeta . $elemento, $elemento);
        }
    }
    // close and save archive
    $zip->close();
    echo "1";
} else {
    die("0");
}
?>
