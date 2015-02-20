<?php
session_start();
include_once '../global.php';
include_once 'global.php';
//ini_set('display_errors', 'On');
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
$folders = array_diff($folders, array('..', '.', '.tmp', '.pdf', '.backups', '.informes'));
// Añadimos a un array la ruta actual
$ruta = str_replace($dirOrig,'',$dir);
$breadcrumb = explode("/",$ruta);
$breadcrumb_nombres = array_filter( $breadcrumb, 'strlen' );
$breadcrumb_ruta = $breadcrumb_nombres;
$count = sizeof($breadcrumb_nombres);
for($i = 1; $i < $count ; $i++) {
    $breadcrumb_ruta[$i+1] = $breadcrumb_nombres[$i] .'/'. $breadcrumb_nombres[$i+1];
}

?>
<div id="listado-archivos">
           <form id="formulario-subida" action="modulos/subirElementos.php" class="dropzone">
            <ul class="breadcrumb" style="margin-bottom: 5px;">
                <li><a data-ruta="<?php echo base64_encode($dirOrig) ?>">Inicio</a></li>
               <?php
                for($i = 1; $i <= $count; $i++) {
                $bread = $breadcrumb_nombres[$i];
                if($i == $count){
                ?>
                <li class="active"><?php echo $bread ?></li>
                <?php
                } else {
                    ?>
                <li><a data-ruta="<?php echo base64_encode($dirOrig . '/' . $breadcrumb_ruta[$i]) ?>"><?php echo $bread ?></a></li>
                    <?php
                }
                }
                ?>
            </ul>
            <div class="wrapper-tabla">
            <table id="tabla-archivos" class="table">
            <input id="rutaActualEnd" type="hidden" data-ruta="<?php echo $ruta . '/' ?>">
            <input id="rutaActual" type="hidden" data-ruta="<?php echo $ruta ?>">
            <?php
                foreach ($folders as $file) {
                        ?><tr>
                            <td class="list-icon yellow"><i class="mdi-file-folder"></i></td>
                            <td class="list-name dir" data-ruta="<?php echo base64_encode($dir . "/" . $file) ?>"><span><?php echo $file ?></span></td>
                            <td class="list-check">
                                <div class="checkbox">
                                    <label>
                                        <input data-file="<?php echo $file ?>" type="checkbox" class="file-check">
                                    </label>
                                </div>
                            </td>
                            <td class="list-icon edit">
                                <i class="mdi-content-create edit"></i>
                            </td>
                        </tr><?php
                }
                foreach ($files as $file) {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $color = 'blue';
                    $type = 'mdi-editor-insert-drive-file';
                    switch($ext){
                        case 'pdf':
                            $color = 'red';
                            $type = 'mdi-action-description';
                            break;
                        case 'jpg':
                        case 'png':
                        case 'svg':
                        case 'bmp':
                            $color = 'green';
                            $type = 'mdi-image-image';
                            break;
                        case 'docx':
                        case 'doc':
                            $color = 'blue';
                            $type = 'mdi-action-description';
                            break;
                        case 'zip':
                        case 'gz':
                        case 'rar':
                            $color = 'brown';
                            $type = 'mdi-action-note-add';
                            break;
                        case 'deb':
                        $color = 'yelbrown';
                        $type = 'mdi-action-extension';
                        break;
                        case 'mov':
                        case 'mp4':
                        case 'avi':
                        case 'mkv':
                        $color = 'purple';
                        $type = 'mdi-av-movie';
                        break;
                    }
                ?><tr>
                <td class="list-icon <?php echo $color ?>"><i class="<?php echo $type ?>"></i></td>
                <td class="list-name"><span><?php echo $file ?></span></td>
                <td class="list-check">
                    <div class="checkbox">
                        <label>
                            <input data-file="<?php echo $file ?>" type="checkbox" class="file-check">
                        </label>
                    </div>
                </td>
                <td class="list-icon edit">
                    <i class="mdi-content-create edit"></i>
                </td>
                </tr><?php
}
            ?>
            </table>
               </div>
    </form>
</div>
