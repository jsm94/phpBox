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
           <?php include_once 'listadoArchivos.php'?>
        </div>
        <?php include_once 'modals.php' ?>
    </div>
</div>
