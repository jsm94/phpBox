<div class="container">
    <div class="starter-template">
        <h1 class="center">Bienvenido a <strong style="color:#3f51b5">phpBox</strong></h1>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <!-- Panel inicio sesión -->
                <div id="panelInicioSesion" class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title center">Acceso</h3>
                    </div>
                    <form id="formularioInicioSesion" method="post">
                        <div class="panel-body">
                            <div class="form-group">
                                <input class="form-control floating-label" name="nick" type="text" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <input class="form-control floating-label" name="password" type="password" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="iniciarSesion" class="btn btn-primary" type="button">Iniciar sesión</button>
                                    </span>
                                    <span class="input-group-btn">
                                        <button id="registro" class="btn btn-primary dark" type="button">Registrate</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Panel registro -->
                <div id="panelRegistro" class="panel panel-warning" style="display:none">
                    <div class="panel-heading">
                        <h3 class="panel-title center">Registro</h3>
                    </div>
                    <form id="formularioRegistro" method="post">
                        <div class="panel-body">
                            <div class="form-group">
                                <input id="passwordRegistro" class="form-control floating-label" name="nick" type="text" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <input id="passwordRegistro" class="form-control floating-label" name="password" type="password" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="registrarUsuario" class="btn btn-warning" type="button">Registrate</button>
                                    </span>
                                    <span class="input-group-btn">
                                        <button id="inicioSesion" class="btn btn-warning dark" type="button">Inicia sesión</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
