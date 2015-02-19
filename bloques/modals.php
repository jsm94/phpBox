<div class="modal fade" id="modal-crearCarpeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Nombre de carpeta</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control floating-label" id="nombreCarpeta" type="text" placeholder="Escribe el nombre de la carpeta">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-success crearCarpeta" id="boton-crearCarpeta">Crear</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-eliminarElementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel2">Eliminar elementos</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p>¿Está seguro de eliminar <span id="numElementos"></span>?</p>
                    <p class="text-danger"><small>Tenga en cuenta que si elimina una carpeta borrará todo su contenido interior.</small></p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger eliminarElementos" id="boton-eliminarElementos">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Eliminar backups -->
<div class="modal fade" id="modal-eliminarBackups" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel3">Eliminar backups</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p>¿Está seguro de eliminar <span id="numBackups"></span>?</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger eliminarElementos" id="boton-eliminarBackups">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Eliminar Informes -->
<div class="modal fade" id="modal-eliminarInformes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel4">Eliminar Informes</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p>¿Está seguro de eliminar <span id="numInformes"></span>?</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger eliminarElementos" id="boton-eliminarInformes">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Renombrar elemento -->
<div class="modal fade" id="modal-rename" tabindex="-1" role="dialog" aria-labelledby="myModalLabe5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel5">Renombrar</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control floating-label" id="txtRename" type="text" placeholder="Escribe el nuevo nombre del elemento">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-success renameFile" id="boton-renameFile">Renombrar</a>
            </div>
        </div>
    </div>
</div>


<!-- Enviar informes -->
<div class="modal fade" id="modal-envio" tabindex="-1" role="dialog" aria-labelledby="myModalLabe6" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel6">Enviar informe</h4>
            </div>

            <div class="modal-body">
                <p>Se va a enviar <b><span id="modal-envio-nombreInforme"></span></b>.</p>
                <div>
                    <form id="subida-imagen" action="modulos/subirElementos.php" class="dropzone">
                        <div class="dz-message" data-dz-message>
                            <span class="btn btn-primary">Sube una imagen</span>
                            <small id="nombreImagenSubida">La imagen se añadirá al informe.</small>
                            <!-- 0 -->
                            <div id="loaderSubidaImagen" class="loader" title="0" style="display:none">
                              <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                              width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                              <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                              s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                              c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                              <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                              C22.32,8.481,24.301,9.057,26.013,10.047z">
                              <animateTransform attributeType="xml"
                              attributeName="transform"
                              type="rotate"
                              from="0 20 20"
                              to="360 20 20"
                              dur="0.5s"
                              repeatCount="indefinite"/>
                              </path>
                              </svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-success enviarInforme" id="boton-enviarInforme">Enviar</a>
            </div>
        </div>
    </div>
</div>
