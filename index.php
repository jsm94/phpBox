<?php include_once('global.php') ?>
<!DOCTYPE html>
<html lang="es">
<!-- Incluimos el head -->
<?php include_once $BOX_BLOCKS . 'head.php' ?>
<body>
    <?php include_once $BOX_BLOCKS . 'navbar.php' ?>
    <div class="container">
        <div class="starter-template">
            <h1>Bienvenido a <strong style="color:#3f51b5">phpBox</strong></h1>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Acceso</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input class="form-control floating-label" id="nombreUsuario" type="text" placeholder="Usuario" data-hint="Escribe tu nombre de usuario">
                            </div>
                            <div class="form-group">
                                <input class="form-control floating-label" id="passwordUsuario" type="password" placeholder="Contraseña" data-hint="Escribe tu contraseña">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Button</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script>
        $(function() {
            $.material.init();
        });
    </script>
</body>
</html>
