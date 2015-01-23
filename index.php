<?php include_once('global.php') ?>
<!DOCTYPE html>
<html lang="es">
<!-- Cabecera de la web -->
<?php include_once $BOX_BLOCKS . 'head.php' ?>
<body>
   <!-- Barra superior de navegación principal -->
    <?php include_once $BOX_BLOCKS . 'navbar.php' ?>
    <!-- Contenido por defecto -->
    <?php include_once $BOX_BLOCKS . 'starter.php' ?>

    <?php conectar($BOX_BD_server, $BOX_BD_user, $BOX_BD_pass, $BOX_BD_name) ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
