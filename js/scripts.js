// Inicio de efectos Material Design
$(function () {
    $.material.init();
});

// ---- Iniciar Sesión ---
$("#iniciarSesion").click(function () {
    var datos = $("#formularioInicioSesion").serializeArray();
    $.post("modulos/iniciarSesion.php", datos, function (result) {
        if (result > 0) {
            if (result == 1) {
                $.bootstrapGrowl("Conexión establecida", {
                    type: 'success',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
                // Al entrar en la sesión cargamos en tiempo real la web
                $('#wrapper').fadeOut('fast', function () {
                    $('#wrapper').load('bloques/box.php', function () {
                        $('#wrapper').fadeIn('fast');
                        $(function () {
                            $.material.init();
                            $(document).ready(cargarFunciones());
                        });
                    });
                });
            } else {
                $.bootstrapGrowl("El usuario no existe o la contraseña es incorrecta", {
                    type: 'warning',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
            }
        } else {
            $.bootstrapGrowl("No se puede establecer conexión", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
        }
    });
});

var cargarFunciones = function () {
    // Cambiar de directorio
    $(".dir").click(cargarListado);
    $(".breadcrumb li>a").click(cargarListado);
    $('#boton-crearCarpeta').click(crearCarpeta);
    $('#boton-eliminarElementos').click(eliminarElementos);
    $('#boton-descargar').click(descargarElementos);
    $('.file-check').click(checkboxes);
    subida();
}

// Cargar listado-archivos
var cargarListado = function () {
    var ruta = $(this).attr("data-ruta");
    $('#listado-archivos').fadeOut('fast', function () {
        $('#listado-archivos').load('bloques/listadoArchivos.php?ruta=' + ruta, function () {
            $('#listado-archivos').fadeIn('fast');
            $(function () {
                $.material.init();
                cargarFunciones();
            });
        });
    });
}

// Crear carpeta
var crearCarpeta = function() {
    var carpeta = $('#rutaActualEnd').attr('data-ruta') + $('#nombreCarpeta').val();
    var user = $('#userNick').text();
    $.get("modulos/crearCarpeta.php", {
        usuario: user,
        carpeta: carpeta
    }, function (data) {
        if (data == "ok") {
            $('#modal-crearCarpeta').modal('toggle');
            $('#listado-archivos').fadeOut('fast', function () {
                $('#listado-archivos').load('bloques/listadoArchivos.php?uri=' + $('#rutaActual').attr('data-ruta'), function () {
                    $('#listado-archivos').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
            });
        }
    });
}

// Checkboxes
var archivos = [];
var checkboxes = function(){
    var check = $(this);
    var et = $('#numElementos');
    if (check.prop("checked") == true) {
        archivos.push(check.attr('data-file'));
        $('#boton-eliminar').show();
        $('#boton-descargar').show();
        $('#boton-eliminar').removeClass('hidden');
        $('#boton-descargar').removeClass('hidden');
        $('#boton-eliminar').removeClass('desappear');
        $('#boton-eliminar').addClass('appear');
        $('#boton-descargar').removeClass('desappear');
        $('#boton-descargar').addClass('appear');
        et.text((archivos.length == 1) ? archivos.length + ' elemento' : archivos.length + ' elementos');
    } else {
        archivos.splice(archivos.indexOf(check.attr('data-file')), 1);
        if (archivos.length == 0) {
            $('#boton-eliminar').removeClass('appear');
            $('#boton-eliminar').addClass('desappear');
            $('#boton-descargar').removeClass('appear');
            $('#boton-descargar').addClass('desappear');
            setTimeout(function() {
                if($('#boton-descargar').hasClass('desappear')){
                    $('#boton-eliminar').hide(); // alternative to menu.style.display = 'none';
                    $('#boton-descargar').hide();
                }
            }, 1000)
        }
        et.text((archivos.length == 1) ? archivos.length + ' elemento' : archivos.length + ' elementos');
    }
}

// Eliminar elementos
var eliminarElementos = function() {
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var user = $('#userNick').text();
    var elementos = JSON.stringify(archivos);
    $.get("modulos/eliminarElementos.php", {
        usuario: user,
        carpeta: carpeta,
        elementos: elementos
    }, function (data) {
        if (data == "ok") {
            $('#modal-eliminarElementos').modal('toggle');
            $('#listado-archivos').fadeOut('fast', function () {
                $('#listado-archivos').load('bloques/listadoArchivos.php?uri=' + $('#rutaActual').attr('data-ruta'), function () {
                    $('#listado-archivos').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                        $('#boton-eliminar').removeClass('appear');
                        $('#boton-eliminar').addClass('desappear');
                        $('#boton-descargar').removeClass('appear');
                        $('#boton-descargar').addClass('desappear');
                        setTimeout(function() {
                            if($('#boton-descargar').hasClass('desappear')){
                                $('#boton-eliminar').hide(); // alternative to menu.style.display = 'none';
                                $('#boton-descargar').hide();
                            }
                        }, 1000)
                        archivos = [];
                    });
                });
            });
        }
    });
}
// Descarga de elementos
var downloadURL = function downloadURL(url) {
    var hiddenIFrameID = 'hiddenDownloader',
        iframe = document.getElementById(hiddenIFrameID);
    if (iframe === null) {
        iframe = document.createElement('iframe');
        iframe.id = hiddenIFrameID;
        iframe.style.display = 'none';
        document.body.appendChild(iframe);
    }
    iframe.src = url;
};

var descargarElementos = function() {
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var user = $('#userNick').text();
    var elementos = JSON.stringify(archivos);
    downloadURL('modulos/descargarElementos.php?usuario=' + user + '&carpeta=' + carpeta + '&elementos=' + elementos);
}

// Subida de elementos

var subida = function subida() {
    // Dropzone 1 -  en el visor de archivos
    Dropzone.options.formularioSubida = {
        paramName: "fileToUpload", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        init: function() {
            this.on("processing", function(file) {
                this.options.url = 'modulos/subirElementos.php?ruta='+$('#rutaActualEnd').attr('data-ruta')+'&user='+$('#userNick').text();
            });

            this.on("complete", function(file){
                $.bootstrapGrowl("Archivo subido a <b>" +$('#rutaActualEnd').attr('data-ruta') + '</b>', {
                    type: 'success',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
                $('#listado-archivos').fadeOut('fast', function () {
                    $('#listado-archivos').load('bloques/listadoArchivos.php?uri=' + $('#rutaActual').attr('data-ruta'), function () {
                        $('#listado-archivos').fadeIn('fast');
                        $(function () {
                            $.material.init();
                            archivos = [];
                            cargarFunciones();
                        });
                    });
                });
            });
        }
    };

    // Dropzone 2 - en el botón de subida
    Dropzone.options.botonSubida = {
        paramName: "fileToUpload", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        init: function() {
            this.on("processing", function(file) {
                this.options.url = 'modulos/subirElementos.php?ruta='+$('#rutaActualEnd').attr('data-ruta')+'&user='+$('#userNick').text();
            });

            this.on("complete", function(file){
                $.bootstrapGrowl("Archivo subido a <b>" +$('#rutaActualEnd').attr('data-ruta') + '</b>', {
                    type: 'success',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
                $('#listado-archivos').fadeOut('fast', function () {
                    $('#listado-archivos').load('bloques/listadoArchivos.php?uri=' + $('#rutaActual').attr('data-ruta'), function () {
                        $('#listado-archivos').fadeIn('fast');
                        $(function () {
                            $.material.init();
                            archivos = [];
                            cargarFunciones();
                        });
                    });
                });
            });
        }
    };
}
cargarFunciones();
