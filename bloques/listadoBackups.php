<?php
session_start();
include_once '../global.php';
include_once 'global.php';
ini_set('display_errors', 'On');
$dirOrig = $BOX_RAIZ . $BOX_prefixUser . $_SESSION['nick'];
$dir = $dirOrig . '/.backups';

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
$folders = array_diff($folders, array('..', '.')); // Eliminamos las carpetas indicadas
?>
<div id="listado-backups">
       <!-- subnav backups -->
    <nav class="navbar grey subnav" role="navigation">
        <div class="container">
            <div class="navbar-header nav navbar-nav nav-inline">
                <li id="boton-eliminar-backup" class="disabled"><a role="menuitem" data-target="#modal-eliminarElementos" data-toggle="modal"><i class="mdi-action-delete"></i><span class="text-option hidden-xs">Eliminar</span></a>
                </li>
                <li id="boton-descargar-backup" class="disabled"><a role="menuitem" data-target="#modal-descargarElementos" data-toggle="modal"><i class="mdi-content-archive"></i><span class="text-option hidden-xs">Descargar</span></a>
                </li>
            </div>
        </div>
    </nav>

        <div class="wrapper-tabla">
            <table id="tabla-backups" class="table">
                <?php
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
        $color = 'brown';
        $type = 'mdi-action-note-add';
        break;
        case 'deb':
        $color = 'yelbrown';
        $type = 'mdi-action-extension';
        break;
    }
                ?><tr>
                <td class="list-icon <?php echo $color ?>"><i class="<?php echo $type ?>"></i></td>
                <td class="list-name"><?php echo $file ?></td>
                <td></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input data-file="<?php echo $file ?>" type="checkbox" class="backup-check">
                        </label>
                    </div>
                </td>
                </tr><?php
}
                ?>
            </table>
        </div> <!-- .wrapper-tabla -->
</div>
