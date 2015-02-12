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
                            $.material.init();
                            cargarFunciones();
                            $('#boton-eliminar').removeClass('appear');
                            $('#boton-eliminar').addClass('desappear');
                            $('#boton-descargar').removeClass('appear');
                            $('#boton-descargar').addClass('desappear');
                            setTimeout(function () {
                                if ($('#boton-descargar').hasClass('desappear')) {
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

// Descargar informes no funciona
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
var subida = function subida() {
    // Dropzone 1 -  en el visor de archivos
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
    };

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
}

// Con la función 'on' se cargarán eventos incluso en los elementos nuevos cargados en el DOM
// Modificar cargarFunciones()
$('body').on('click', '.file-check', checkboxes);
$('body').on('click', '.backup-check', checkBackups);
$('body').on('click', '.informe-check', checkInformes);
$('body').on('click', '#boton-nuevo-informe', crearInforme);
$('body').on('click', '.breadcrumb li>a', cargarListado);
$('body').on('click', '.dir', cargarListado);
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
cargarFunciones();
