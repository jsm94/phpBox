<?php
// Este archivo contendrá todas las variables globales de la aplicación
$_URL = 'phpBox';
$BOX_URI = $_SERVER['DOCUMENT_ROOT'] . '/' . $_URL . '/';
$BOX_BLOCKS = $BOX_URI . 'bloques/';
$BOX_MODS = $BOX_URI . 'modulos/';


// Variables para la base de datos
$BOX_BD_name = 'phpBox';
$BOX_BD_server = 'localhost';
$BOX_BD_user = 'root';
$BOX_BD_pass = 'usuario';

// Carga de módulos principales
require_once $BOX_MODS . 'BD.php';
?>
