<?php
session_start();
// Barra de navegación
include_once 'navbar.php';
include_once 'subnav.php';
// Listado de archivos
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
           <?php include_once 'listadoArchivos.php' ?>
        </div>
    </div>
    <div class="row">
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
    <?php include_once 'modals.php' ?>
</div>
