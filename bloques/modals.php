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
