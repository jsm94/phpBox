<?php
session_start();
include_once '../global.php';
include_once 'global.php';
ini_set('display_errors', 'On');
$dirOrig = $BOX_RAIZ . $BOX_prefixUser . $_SESSION['nick'];
$dir = $dirOrig;

if(isset($_GET['ruta'])){
    $dir = base64_decode($_GET['ruta']);
} else if(isset($_GET['uri'])){
    $dir .= $_GET['uri'];
}

// array_diff(scandir($dir), array('..', '.'))
$files = array();
$folders = array();
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        $cont1 = 0;
        $cont2 = 0;
        while (($file = readdir($dh)) !== false) {
            if(!is_dir($dir . '/' . $file)){
                $files[$cont1] = $file;
                $cont1++;
            } else {
                $folders[$cont2] = $file;
                $cont2++;
            }
        }
        closedir($dh);
    }
}
$folders = array_diff($folders, array('..', '.', '.tmp'))
?>
            <table id="listado-archivos" class="table">
            <input id="rutaActual" type="hidden" data-ruta="<?php echo str_replace($dirOrig,'',$dir) . '/' ?>"></input>
            <?php
                foreach ($folders as $file) {
                        ?><tr>
                            <td class="list-icon yellow"><i class="mdi-file-folder"></i></td>
                            <td class="list-name dir" data-ruta="<?php echo base64_encode($dir . "/" . $file) ?>"><?php echo $file ?></td>
                            <td></td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input data-file="<?php echo $file ?>" type="checkbox" class="file-check">
                                    </label>
                                </div>
                            </td>
                        </tr><?php
                }
                foreach ($files as $file) {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $color = 'blue';
                    switch($ext){
                        case 'pdf':
                            $color = 'red';
                            break;
                        case 'jpg':
                            $color = 'green';
                            break;
                    }
                ?><tr>
                <td class="list-icon <?php echo $color ?>"><i class="mdi-editor-insert-drive-file"></i></td>
                <td class="list-name"><?php echo $file ?></td>
                <td></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input data-file="<?php echo $file ?>" type="checkbox" class="file-check">
                        </label>
                    </div>
                </td>
                </tr><?php
}
            ?>
            </table>
