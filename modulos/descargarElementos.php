<?php
ini_set('display_errors', 'On');
session_start();
include_once '../global.php';
include_once 'global.php';
$raizUsuario = $_GET['usuario'];
$carpeta = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . $_GET['carpeta'];
$elementos = json_decode($_GET['elementos']);
$bk = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.tmp/backup.zip';


if($raizUsuario == $_SESSION['nick']){

    if(sizeof($elementos) == 1){ // Descargar sólo un elemento
        $bk = $BOX_RAIZ . $BOX_prefixUser . $raizUsuario . '/.tmp/' . $elementos[0];
        if(file_exists($bk)) unlink($bk);
        copy($carpeta . $elementos[0], $bk);
    } else { // Comprimir varios elementos y descargar
        // create object
        $zip = new ZipArchive();
        if(file_exists($bk)) unlink($bk);

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
    }

    echo "Archive created successfully.";
    if(file_exists($bk)) {
        ignore_user_abort(true);
        header('Content-Description: Transferencia de archivos');
        header('Content-Type: mime/type');
        header('Content-Disposition: attachment; filename='.basename($bk));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($bk));
        ob_clean();
        flush();
        readfile($bk);
        unlink($bk);
        exit;
    }
    echo "ok";
} else {
    die("0");
}
?>
