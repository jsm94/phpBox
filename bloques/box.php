<?php
session_start();
// Barra de navegación
include_once 'navbar.php';
include_once 'subnav.php';
// Listado de archivos
?>
<div class="container-fluid">
    <div class="row contenido">
        <div class="col-md-4 col-lg-3 col-sm-4 hidden-xs">
            <div class="col-md-12 col-sm-12 gray">
                <div class="col-md-12 col-sm-12 titulo-info-file">
                    <h2><i id="info-simbol"></i><span id="info-name">Información de archivos</span></h2>
                </div>
                <div class="col-md-12 col-sm-12 init-info-file">
                    <div class="col-md-12 col-sm-12 v1-align"><i class="mdi-action-info"></i></div>
                    <div class="col-md-12 col-sm-12 v2-align"><p>Pulsa en un archivo para consultar su estado</p></div>
                </div>
                <div class="col-md-12 col-sm-12 body-info-file hidden">
                    <p><i class="mdi-content-save"></i><span>Espacio ocupado en disco:</span></p>
                    <p id="info-fileSize" class="info-file"></p>
                    <p><i class="mdi-notification-event-note"></i><span>Fecha de modificación:</span></p>
                    <p id="info-fileMtime" class="info-file"></p>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 col-sm-8">
           <?php include_once 'listadoArchivos.php' ?>
       </div>
   </div>
   <div class="row listados">
    <div class="col-md-12 line"></div>
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <?php include_once 'listadoBackups.php' ?>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
            <?php include_once 'listadoInformes.php' ?>
        </div>
    </div>
</div>
<?php include_once $BOX_BLOCKS . 'footer.php' ?>
<?php include_once 'modals.php' ?>
</div>
