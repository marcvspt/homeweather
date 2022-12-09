//CRUD USUARIO
function enviar(valor) {
    var alerta;
    switch (valor) {
        case "actualizar":
            alerta = actualizar();
            break;
        case 'eliminar':
            alerta = eliminar();
            break;
    }

    console.log(alerta);
    alert("Hecho! regresando a la sección de usuarios");
    location.href = 'users.php';
}

function actualizar() {
    var actualizar_mensaje;
    jQuery(document).on('submit', '#usuarios', function (event) {
        event.preventDefault();

        jQuery.ajax({
            url: 'actualizar.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            }
        })
            .done(function (respuesta) {
                console.log(respuesta);
                if (!respuesta.error) {
                    actualizar_mensaje = "Datos actualizados!";
                } else {
                    actualizar_mensaje = "Algo ha salido mal, por favor intentalo más tarde";
                }
            })
            .fail(function (resp) {
                console.log(resp.responseText);
            })
            .always(function () {
                console.log();
            });
    });

    return actualizar_mensaje;
}

function eliminar() {
    var eliminar_mensaje;
    jQuery(document).on('submit', '#usuarios', function (event) {
        event.preventDefault();

        jQuery.ajax({
            url: 'eliminar.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            }
        })
            .done(function (respuesta) {
                console.log(respuesta);
                if (!respuesta.error) {
                    eliminar_mensaje = "Usuario eliminado!";
                } else {
                    eliminar_mensaje = "Algo ha salido mal, por favor intentalo más tarde";
                }
            })
            .fail(function (resp) {
                console.log(resp.responseText);
            })
            .always(function () {
                console.log();
            });
    });

    return eliminar_mensaje;
}