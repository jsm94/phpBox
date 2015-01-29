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
                $('#wrapper').fadeOut('slow', function () {
                    $('#wrapper').load('bloques/box.php', function () {
                        $('#wrapper').fadeIn('slow');
                        $(function () {
                            $.material.init();
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

var cargarFunciones = function() {
    $(".dir").click(function() {
        var ruta = $(this).attr("data-ruta");
        $('#listado-archivos').fadeOut('slow', function () {
            $('#listado-archivos').load('bloques/listadoArchivos.php?ruta=' + ruta, function () {
                $('#listado-archivos').fadeIn('slow');
                $(function () {
                    $.material.init();
                    cargarFunciones();
                });
            });
        });
    });
}

cargarFunciones();
