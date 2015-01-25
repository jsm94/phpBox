<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">phpBox</a>
        </div>

        <div class="collapse navbar-collapse">
            <!-- Navegación -->
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Inicio</a>
                </li>
                <li><a href="modulos/cerrarSesion.php">Cerrar sesión</a>
                </li>
                <li><a href="#contact">Contact</a>
                </li>
            </ul>
            <!-- Usuario -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">@<?php echo $_SESSION['nick']?></a></li>
                <li><a href="modulos/cerrarSesion.php" style="padding:0"><button class="btn btn-danger btn-xs">Cerrar sesión</button></a></li>
            </ul>
        </div>
        <!--.nav-collapse -->
    </div>
</nav>
