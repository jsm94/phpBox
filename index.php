<?php
session_start();
include_once('global.php')
?>
<!DOCTYPE html>
<html lang="es">
<!-- Cabecera de la web -->
<?php include_once $BOX_BLOCKS . 'head.php' ?>
<body>
    <div id="wrapper">
       <!-- Barra superior de navegación principal -->
        <?php
        if(!isset($_SESSION['nick'])){
            // Contenido por defecto
            include_once $BOX_BLOCKS . 'starter.php';
        } else {
            // Aplicación
            include_once $BOX_BLOCKS . 'box.php';
        }
        ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
    <script src="//cdn.jsdelivr.net/velocity/1.2.1/velocity.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
