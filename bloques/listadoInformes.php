<?php
session_start();
include_once '../global.php';
include_once 'global.php';
//ini_set('display_errors', 'On');
$dirOrig = $BOX_RAIZ . $BOX_prefixUser . $_SESSION['nick'];
$dir = $dirOrig . '/.informes';

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
<div id="listado-informes">
    <!-- subnav informes -->
    <nav class="navbar lite subnav no-margin" role="navigation">
        <div class="container">
            <div class="navbar-header nav navbar-nav nav-inline">
                <li id="boton-eliminar-backup" class="disabled"><a role="menuitem" data-target="#modal-eliminarInformes" data-toggle="modal"><i class="mdi-action-delete"></i><span class="text-option hidden-xs">Eliminar</span></a>
                </li>
                <li id="boton-descargar-informe" class="disabled"><a role="menuitem"><i class="mdi-content-archive"></i><span class="text-option hidden-xs">Descargar</span></a>
                </li>
            </div>
        </div>
    </nav>
    <!-- //subnav informes -->

    <div class="wrapper-tabla">
        <table id="tabla-informes" class="table">
            <?php
foreach ($files as $file) {
            ?><tr>
            <td class="list-icon brown"><i class="mdi-action-description"></i></td>
            <td class="list-name"><?php echo $file ?></td>
            <td></td>
            <td>
                <div class="checkbox">
                    <label>
                        <input data-file="<?php echo $file ?>" type="checkbox" class="informe-check">
                    </label>
                </div>
            </td>
            </tr><?php
}
            ?>
        </table>
    </div> <!-- .wrapper-tabla -->
</div>
