<nav class="navbar grey subnav" role="navigation">
    <div class="container">
        <div class="navbar-header nav navbar-nav nav-inline">
            <li class="dropdown hidden-md hidden-sm hidden-lg" id="menu-nuevo"><a href="#" class="dropdown-toggle"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" role="button" aria-expanded="false"><i class="mdi-content-add-circle-outline"></i><span class="text-option hidden-xs">Nuevo</span></a>
            </li>
            <li class="dropdown hidden-xs" id="menu-nuevo"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="mdi-content-add-circle-outline"></i><span class="text-option">Nuevo</span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu-nuevo">
                    <li id="crearCarpeta" role="presentation"><a role="menuitem" href="#" data-target="#modal-crearCarpeta" data-toggle="modal"><i class="mdi-file-folder"></i><span>Carpeta</span></a>
                    </li>
                </ul>
            </li>
            <li id="boton-subir"><form id="boton-subida" action="modulos/subirElementos.php" class="dropzone"><div class="dz-message" data-dz-message><a href="#"><i class="mdi-file-cloud-upload"></i><span class="text-option hidden-xs">Subir</span></a></div></form>
            </li>
            <li id="boton-eliminar" class="hidden appear"><a role="menuitem" data-target="#modal-eliminarElementos" data-toggle="modal"><i class="mdi-action-delete"></i><span class="text-option hidden-xs">Eliminar</span></a>
            </li>
            <li id="boton-descargar" class="hidden appear"><a role="menuitem" data-target="#modal-descargarElementos" data-toggle="modal"><i class="mdi-file-cloud-download"></i><span class="text-option hidden-xs">Descargar</span></a>
            </li>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- Colapsed menu -->
            <ul class="nav navbar-nav hidden-md hidden-sm hidden-lg v-align" role="menu" aria-labelledby="menu-nuevo">
                <li id="crearCarpeta" role="presentation"><a role="menuitem" href="#" data-target="#modal-crearCarpeta" data-toggle="modal"><i class="mdi-file-folder"></i><span>Carpeta</span></a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
