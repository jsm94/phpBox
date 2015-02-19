// Inicio de efectos Material Design
$(function () {
    $.material.init();
    Dropzone.autoDiscover = false;
    if($('#boton-subida').val() !== undefined){
        $("#boton-subida").dropzone({ url: 'modulos/subirElementos.php?ruta=' + $('#rutaActualEnd').attr('data-ruta') + '&user=' + $('#userNick').text() });
        $("#subida-imagen").dropzone({ url: 'modulos/subirElementos.php?ruta=/.tmp/' + '&user=' + $('#userNick').text() });
    }
});

// ---- Botones registro e inicioSesion ---
$("#registro").click(function() {
    $("#panelInicioSesion").fadeOut('fast', function() {
        $("#panelRegistro").fadeIn('fast');
    });
});

$('#inicioSesion').click(function() {
    $('#panelRegistro').fadeOut('fast', function() {
        $('#panelInicioSesion').fadeIn('fast');
    });
});

var dropzones = function () {
    $("#boton-subida").dropzone({ url: 'modulos/subirElementos.php?ruta=' + $('#rutaActualEnd').attr('data-ruta') + '&user=' + $('#userNick').text() });
    $("#subida-imagen").dropzone({ url: 'modulos/subirElementos.php?ruta=/.tmp/' + '&user=' + $('#userNick').text() });
}

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
                            $(document).ready(cargarFunciones);
                            $(document).ready(dropzones);
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


// ---- Registro ----
$('#registrarUsuario').click(function() {
    if ($('#passwordRegistro').val() === '' || $('#nickRegistro').val() === '' || $('#emailRegistro').val() === '') {
        $.bootstrapGrowl("No puede dejar campos vacíos", {
            type: 'warning',
            align: 'center',
            width: 'auto',
            allow_dismiss: false
        });
    } else {
        var datos = $("#formularioRegistro").serializeArray();
        $.post('modulos/registro.php',datos, function(data) {
            // Comprobamos el resultado
            if (data == 2) {
                $.bootstrapGrowl("Ya existe ese nombre de usuario", {
                    type: 'info',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
            } else if(data == 1){
                $.bootstrapGrowl("Usuario creado con éxito", {
                    type: 'success',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
                $('#panelRegistro').fadeOut('fast', function() {
                    $('#panelInicioSesion').fadeIn('fast');
                });
            } else {
                $.bootstrapGrowl("Conexión fallida", {
                    type: 'danger',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
            }
        });
}
});

// Conversor bytes
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Byte';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};

var cargarFunciones = function () {
    // Cambiar de directorio
    archivos = [];
    backups = [];
    informes = [];
    checkboxes();
    checkBackups();
    checkInformes();
    $(".checkbox input").prop("checked", false);
    /*
    $(".dir").click(cargarListado);
    $(".breadcrumb li>a").click(cargarListado);

    $('#boton-crearCarpeta').click(crearCarpeta);
    $('#boton-eliminarElementos').click(eliminarElementos);
    $('#boton-descargar').click(descargarElementos);
    $('#boton-backup').click(crearBackup);
    $('#boton-eliminar-backup').click(modalBackup);
    $('#boton-descargar-backup').click(descargarBackups);
    $('#boton-eliminarBackups').click(eliminarBackups);
    $('#boton-eliminar-informes').click(modalInforme);
    $('#boton-eliminarInformes').click(eliminarInformes);
    $('#boton-descargar-informes').click(descargarInformes);*/

    /*
    $('.file-check').click(checkboxes);
    $('.backup-check').click(checkBackups);
    $('.informe-check').click(checkInformes);*/

    // Subida de archivos
    subida();
    $.material.init();
}

// Cargar listado-archivos
var cargarListado = function () {
    var ruta = $(this).parent('.dir').attr("data-ruta");
    $('#listado-archivos').fadeOut('fast', function () {
        $('#listado-archivos').load('bloques/listadoArchivos.php?ruta=' + ruta, function () {
            $('#listado-archivos').fadeIn('fast');
            $(function () {
                cargarFunciones();
            });
        });
    });
}

var cargarListadoBread = function () {
    var ruta = $(this).attr("data-ruta");
    $('#listado-archivos').fadeOut('fast', function () {
        $('#listado-archivos').load('bloques/listadoArchivos.php?ruta=' + ruta, function () {
            $('#listado-archivos').fadeIn('fast');
            $(function () {
                cargarFunciones();
            });
        });
    });
}

// Informacion archivos
var infoFile = function () {
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var user = $('#userNick').text();
    var elemento = $(this).children('span').text();
    var simbol = $(this).parent().find('i').attr('class');
    console.log(simbol);
    // Realizamos la peticion
    $.get("modulos/infoFile.php", {
        usuario: user,
        carpeta: carpeta,
        elemento: elemento
    }, function (data) {
        var datos = JSON.parse(JSON.stringify(data));
        var size = datos.size;
        var mtime = datos.mtime;
        //console.log(size + ' ' + mtime); //Formateamos
        $('.init-info-file').addClass('hidden');
        $('.body-info-file').removeClass('hidden');
        $('#info-simbol').attr("class", simbol);
        $('#info-name').text(elemento);
        $('#info-fileSize').text(bytesToSize(size));
        // Fecha de modificación
        date = new Date(mtime * 1000);
        var month = date.getMonth()+1;
        var day = date.getDate();
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        mdate = [
        date.getFullYear(),
        (month < 10) ? '0' + month : month,
        (day < 10) ? '0' + day : day,
        (hour < 10) ? '0' + hour : hour,
        (min < 10) ? '0' + min : min,
        (sec < 10) ? '0' + sec : sec,
        ];
        $('#info-fileMtime').text(mdate[2] + '/' + mdate[1] + '/' + mdate[0] + ' ' + mdate[3] + ':' + mdate[4] + ':' + mdate[5]);
    });

}

// Crear carpeta
var crearCarpeta = function () {
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
var backups = [];
var informes = [];
var checkboxes = function () {
    var check = $(this);
    var et = $('#numElementos');
    if (check.prop("checked") === true) {
        archivos.push(check.attr('data-file'));
        $('#boton-eliminar').show();
        $('#boton-descargar').show();
        $('#boton-backup').show();
        $('#boton-eliminar').removeClass('hidden');
        $('#boton-descargar').removeClass('hidden');
        $('#boton-backup').removeClass('hidden');
        $('#boton-eliminar').removeClass('desappear');
        $('#boton-eliminar').addClass('appear');
        $('#boton-descargar').removeClass('desappear');
        $('#boton-descargar').addClass('appear');
        $('#boton-backup').removeClass('desappear');
        $('#boton-backup').addClass('appear');
        et.text((archivos.length === 1) ? archivos.length + ' elemento' : archivos.length + ' elementos');
    } else {
        archivos.splice(archivos.indexOf(check.attr('data-file')), 1);
        if (archivos.length === 0) {
            $('#boton-eliminar').removeClass('appear');
            $('#boton-eliminar').addClass('desappear');
            $('#boton-descargar').removeClass('appear');
            $('#boton-descargar').addClass('desappear');
            $('#boton-backup').removeClass('appear');
            $('#boton-backup').addClass('desappear');
            setTimeout(function () {
                if ($('#boton-descargar').hasClass('desappear')) {
                    $('#boton-eliminar').hide(); // alternative to menu.style.display = 'none';
                    $('#boton-descargar').hide();
                    $('#boton-backup').hide();
                }
            }, 1000)
        }
        et.text((archivos.length === 1) ? archivos.length + ' elemento' : archivos.length + ' elementos');
    }
}

var checkBackups = function () {
    var check = $(this);
    var et = $('#numBackups');
    if (check.prop("checked") === true) {
        backups.push(check.attr('data-file'));
        $('#boton-eliminar-backup').removeClass('disabled');
        $('#boton-descargar-backup').removeClass('disabled');
        //console.log("Backups: " + backups.length);
        et.text((backups.length === 1) ? backups.length + ' elemento' : backups.length + ' elementos');
    } else {
        backups.splice(backups.indexOf(check.attr('data-file')), 1);
        if (backups.length === 0) {
            $('#boton-eliminar-backup').addClass('disabled');
            $('#boton-descargar-backup').addClass('disabled');
        }
        //console.log("Backups: " + backups.length);
        et.text((backups.length === 1) ? backups.length + ' elemento' : backups.length + ' elementos');
    }
}

var checkInformes = function () {
    var check = $(this);
    var et = $('#numInformes');
    if (check.prop("checked") === true) {
        informes.push(check.attr('data-file'));
        $('#boton-eliminar-informes').removeClass('disabled');
        $('#boton-descargar-informes').removeClass('disabled');
        console.log("Informes: " + informes);
        et.text((informes.length === 1) ? informes.length + ' informe' : informes.length + ' informes');
    } else {
        informes.splice(informes.indexOf(check.attr('data-file')), 1);
        if (informes.length === 0) {
            $('#boton-eliminar-informes').addClass('disabled');
            $('#boton-descargar-informes').addClass('disabled');
        }
        console.log("Informes: " + informes);
        et.text((informes.length === 1) ? informes.length + ' informe' : informes.length + ' informes');
    }
}

// -Checkboxes

// Eliminar elementos
var eliminarElementos = function () {
        //if(archivos.length < 1) $('#modal-eliminarElementos').modal('hide');
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
                            cargarFunciones();
                            $('#boton-eliminar').removeClass('appear');
                            $('#boton-eliminar').addClass('desappear');
                            $('#boton-descargar').removeClass('appear');
                            $('#boton-descargar').addClass('desappear');
                            setTimeout(function () {
                                if ($('#boton-descargar').hasClass('desappear')) {
                                    $('#boton-eliminar').hide(); // alternativa a menu.style.display = 'none';
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

// Renombrar elementos
var oldName = '';
var modalRename = function () {
    oldName = $(this).closest('tr').find('.list-name').text();
    // Mostramos el cuadro de diálogo de renombre
    $('#modal-rename').modal('show');
}

var renameFile = function () {
    var newName = $('#txtRename').val();
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var user = $('#userNick').text();
    console.log("carpeta: "+carpeta+" usuario: "+user);
    $.get("modulos/renameFile.php", {
        usuario: user,
        carpeta: carpeta,
        elemento: oldName,
        nombre: newName
    }, function (data) {
        if (data == "1") {
            $('#modal-rename').modal('toggle');
            // Mensaje
            $.bootstrapGrowl("<b>"+oldName+"</b> ha sido renombrado por <b>"+newName+"</b>", {
                type: 'success',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
            // Cargado de archivos
            $('#listado-archivos').fadeOut('fast', function () {
                $('#listado-archivos').load('bloques/listadoArchivos.php?uri=' + $('#rutaActual').attr('data-ruta'), function () {
                    $('#listado-archivos').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
            });
        } else if (data == '2') {
            // Mensaje
            $.bootstrapGrowl("Ya existe otro elemento con ese nombre", {
                type: 'warning',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
        };
    });

}

// Enviar informe
var nameInforme;
var modalEnvio = function () {
    nameInforme = $(this).closest('tr').find('.list-name').text();
    $('#modal-envio-nombreInforme').text(nameInforme);
    // Mostramos el cuadro de diálogo de renombre
    $('#modal-envio').modal('show');
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
}

var descargarElementos = function () {
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var user = $('#userNick').text();
    var elementos = JSON.stringify(archivos);
    downloadURL('modulos/descargarElementos.php?usuario=' + user + '&carpeta=' + carpeta + '&elementos=' + elementos);
}

var descargarBackups = function () {
    var user = $('#userNick').text();
    var elementos = JSON.stringify(backups);
    downloadURL('modulos/descargarElementos.php?usuario=' + user + '&carpeta=/.backups/&elementos=' + elementos);
}

// Descargar informes
var descargarInformes = function () {
    var user = $('#userNick').text();
    var elementos = JSON.stringify(informes);
    //var elementos = JSON.stringify(backups);
    //downloadURL('modulos/descargarElementos.php?usuario=' + user + '&carpeta=/.backups/&elementos=' + elementos);
    downloadURL('modulos/descargarElementos.php?usuario=' + user + '&carpeta=/.informes/&elementos=' + elementos);
    //alert('descargar: ' + elementos);
}

// Crear backup
var crearBackup = function () {
    var user = $('#userNick').text();
    var carpeta = $('#rutaActualEnd').attr('data-ruta');
    var elementos = JSON.stringify(archivos);
    $.get('modulos/crearBackup.php', {
        usuario: user,
        carpeta: carpeta,
        elementos: elementos
    }, function (data) {
        if (data === '1') {
            // Cargar listado backups
            $('#listado-backups').fadeOut('fast', function () {
                $('#listado-backups').load('bloques/listadoBackups.php', function () {
                    $('#listado-backups').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
            });

            /* Cargar listado informes
            $('#listado-informes').fadeOut('fast', function () {
                $('#listado-informes').load('bloques/listadoInformes.php', function () {
                    $('#listado-informes').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
});*/
}
});
}

// Crear Informe
var crearInforme = function () {
    var user = $('#userNick').text();
    $.get('modulos/crearInforme.php', {
        usuario: user
    }, function (data) {
        if (data === '1') {
            // Mensaje
            $.bootstrapGrowl("Informe creado", {
                type: 'success',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
            // Cargar listado backups
            $('#listado-informes').fadeOut('fast', function () {
                $('#listado-informes').load('bloques/listadoInformes.php', function () {
                    $('#listado-informes').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
            });

            /* Cargar listado informes
            $('#listado-informes').fadeOut('fast', function () {
                $('#listado-informes').load('bloques/listadoInformes.php', function () {
                    $('#listado-informes').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                    });
                });
})*/
}
});
}
var imagenInforme = '';
var enviarInforme = function () {
    var user = $('#userNick').text();
    $('#boton-enviarInforme').text('Enviando...');
    $('#loaderSubidaImagen').show();
    $.get('modulos/enviarInforme.php', {
        usuario: user,
        informe: nameInforme,
        imagen: imagenInforme
    }, function (data) {
        if(data == 1){
            $('#modal-envio').modal('hide');
            $.bootstrapGrowl("Informe enviado", {
                type: 'success',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
            $('#boton-enviarInforme').text('Enviar');
            $('#loaderSubidaImagen').toggle();
            $('#nombreImagenSubida').text('La imagen se añadirá al informe.');
            $('#modal-envio').modal('hide');
            imagenInforme = '';
        } else {
            $.bootstrapGrowl("Error al enviar el informe", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
            imagenInforme = '';
        }
    });
}

// Modal eliminar backups
var modalBackup = function () {
    if(backups.length > 0) $('#modal-eliminarBackups').modal('show');
}

// Modal eliminar informes
var modalInforme = function () {
    if(informes.length > 0) $('#modal-eliminarInformes').modal('show');
}

// Eliminar backup
var eliminarBackups = function () {
    var carpeta = '/.backups/';
    var user = $('#userNick').text();
    var elementos = JSON.stringify(backups);
    $.get("modulos/eliminarElementos.php", {
        usuario: user,
        carpeta: carpeta,
        elementos: elementos
    }, function (data) {
        if (data == "ok") {
            $('#modal-eliminarBackups').modal('toggle');
            $('#listado-backups').fadeOut('fast', function () {
                $('#listado-backups').load('bloques/listadoBackups.php', function () {
                    $('#listado-backups').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                        $('#boton-eliminar-backup').addClass('disabled');
                        $('#boton-descargar-backup').addClass('disabled');
                        backups = [];
                    });
                });
            });
        }
    });
}


// Eliminar Informe

var eliminarInformes = function () {
    var carpeta = '/.informes/';
    var user = $('#userNick').text();
    var elementos = JSON.stringify(informes);
    $.get("modulos/eliminarElementos.php", {
        usuario: user,
        carpeta: carpeta,
        elementos: elementos
    }, function (data) {
        if (data == "ok") {
            $('#modal-eliminarInformes').modal('toggle');
            $('#listado-informes').fadeOut('fast', function () {
                $('#listado-informes').load('bloques/listadoInformes.php', function () {
                    $('#listado-informes').fadeIn('fast');
                    $(function () {
                        $.material.init();
                        cargarFunciones();
                        $('#boton-eliminar-informes').addClass('disabled');
                        $('#boton-descargar-informes').addClass('disabled');
                        informes = [];
                    });
                });
            });
        }
    });
}

// Subida de elementos
var subida = function () {
    /* Dropzone 1 -  en el visor de archivos
    Dropzone.options.formularioSubida = {
        paramName: "fileToUpload", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        init: function () {
            this.on("processing", function (file) {
                this.options.url = 'modulos/subirElementos.php?ruta=' + $('#rutaActualEnd').attr('data-ruta') + '&user=' + $('#userNick').text();
            });

            this.on("complete", function (file) {
                $.bootstrapGrowl("Archivo subido a <b>" + $('#rutaActualEnd').attr('data-ruta') + '</b>', {
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
    };*/

    // Dropzone 2 - en el botón de subida
    Dropzone.options.botonSubida = {
        paramName: "fileToUpload", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        init: function () {
            this.on("processing", function (file) {
                this.options.url = 'modulos/subirElementos.php?ruta=' + $('#rutaActualEnd').attr('data-ruta') + '&user=' + $('#userNick').text();
            });

            this.on("complete", function (file) {
                $.bootstrapGrowl("Archivo subido a <b>" + $('#rutaActualEnd').attr('data-ruta') + '</b>', {
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

    // Dropzone 3 - subida de imagen para el pdf
    Dropzone.options.subidaImagen = {
        paramName: "fileToUpload", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        acceptedFiles: 'image/*',
        parallelUploads: 1,
        init: function () {
            this.on("processing", function (file) {
                this.options.url = 'modulos/subirElementos.php?ruta=/.tmp/' + '&user=' + $('#userNick').text();
            });

            this.on("complete", function (file) {
                imagenInforme = file.name;
                $('#nombreImagenSubida').text(imagenInforme);
            });
        }
    };
    //console.log('yep');
}

// Con la función 'on' se cargarán eventos incluso en los elementos nuevos cargados en el DOM
// Modificar cargarFunciones()
$('body').on('click', '.file-check', checkboxes);
$('body').on('click', '.backup-check', checkBackups);
$('body').on('click', '.informe-check', checkInformes);
$('body').on('click', '#boton-nuevo-informe', crearInforme);
$('body').on('click', '.breadcrumb li>a', cargarListadoBread);
$('body').on('click', '.dir>span', cargarListado);
$('body').on('click', '#boton-crearCarpeta', crearCarpeta);
$('body').on('click', '#boton-eliminarElementos', eliminarElementos);
$('body').on('click', '#boton-descargar', descargarElementos);
$('body').on('click', '#boton-backup', crearBackup);
$('body').on('click', '#boton-eliminar-backup', modalBackup);
$('body').on('click', '#boton-descargar-backup', descargarBackups);
$('body').on('click', '#boton-eliminarBackups', eliminarBackups);
$('body').on('click', '#boton-eliminar-informes', modalInforme);
$('body').on('click', '#boton-eliminarInformes', eliminarInformes);
$('body').on('click', '#boton-descargar-informes', descargarInformes);
$('body').on('click', '#boton-enviarInforme', enviarInforme);
$('body').on('click', 'i.edit', modalRename);
$('body').on('click', 'i.mail', modalEnvio);
$('body').on('click', '#boton-renameFile', renameFile);
$('body').on('click', '#listado-archivos .list-name', infoFile);
cargarFunciones();
