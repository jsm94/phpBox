<nav class="navbar navbar-inverse no-margin" role="navigation">
    <div class="container">
        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="#">phpBox</a>
        </div>

        <div class="navbar-header pull-right">
            <a href="" class="linkUser">@<span id="userNick"><?php echo $_SESSION['nick']?></span></a>
            <a href="modulos/cerrarSesion.php" style="padding:0" class="hidden-md hidden-lg hidden-sm">
                <button class="btn btn-danger btn-xs navbar-btn btn-icon"><i class="mdi-action-lock"></i></button>
            </a>
            <a href="modulos/cerrarSesion.php" style="padding:0" class="hidden-xs">
                <button class="btn btn-danger btn-xs navbar-btn">Cerrar sesión</button>
            </a>
        </div>
        <!--
        <div id="navbar-collapse" class="collapse navbar-collapse">-->
            <!-- Usuario
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">@<span id="userNick"></span></a>
                </li>
                <li>
                    <a href="modulos/cerrarSesion.php" style="padding:0">
                        <button class="btn btn-danger btn-xs navbar-btn">Cerrar sesión</button>
                    </a>
                </li>
            </ul>
        </div>
        .nav-collapse -->
    </div>
</nav>
