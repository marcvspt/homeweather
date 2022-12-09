//PERFIL
jQuery(document).on('submit', '#perfil', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'actualizar_perfil.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                alert('Datos actualizados!');
                location.reload();
            } else {
                alert('Ha ocurrido un error, intentelo más tarde');
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log();
        });
});

//PERFIL
jQuery(document).on('submit', '#clave', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'actualizar_clave.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                alert('Contraseña actualizada!');
                location.reload();
            } else {
                if (respuesta.tipo = "igual") {
                    alert('La contraseña actual, no coincide');
                } else if (respuesta.tipo = "no igual") {
                    alert('Repita la contraseña nueva correctamente');
                } else {
                    alert('Ha ocurrido un error, intentelo más tarde');
                }
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log();
        });
});