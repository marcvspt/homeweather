//LOGUIN
jQuery(document).on('submit', '#login-m', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'login/check-login.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                if (respuesta.status == "Activo") {
                    alert('Bienvenido de nuevo!');
                    if(respuesta.rol == 1){ //User
                        location.href = 'user/index.php';
                    }else if(respuesta.rol == 2){ //Admin
                        location.href = 'admin/index.php';
                    }
                } else if (respuesta.status == "No Activo") {
                    alert('Esta cuenta no está activada, contacte a soporte');
                } else if (respuesta.status == "En espera") {
                    alert('Verifique su correo electronico, para activar esta cuenta');
                }
            } else {
                alert('Usuario o contraseña incorrectos');
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log();
        });
});

//REGISTRO
jQuery(document).on('submit', '#registro-m', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'login/create-account.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                if (respuesta.status == "Activo"){
                    alert('Cuenta creada con éxito! Por favor, inicie sesión');
                } else{
                    alert('Algo ha salido mal, intentelo más tarde');
                }
            } else {
                if (respuesta.tipo == "existe") {
                    alert('El correo electronico ya ha sido registrado');
                } else if (respuesta.tipo == "no igual") {
                    alert('Debe repetir la contraseña correctamente');
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

//CLAVE CORREO
jQuery(document).on('submit', '#correo-clave', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'recuperar.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                alert('Se ha enviado un correo electronico para cambiar su contraseña');
            } else {
                alert('Algo ha salido mal');
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log();
        });
});

//CLAVE CORREO
jQuery(document).on('submit', '#clave', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: 'login/nueva-clave.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {

        }
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                alert('Se ha cambiado la contraseña, vuelva a la pagina de ingreso');
                location.href = 'index.html';
            } else {
                if (respuesta.tipo == "no igual"){
                    alert('Debe repetir la contraseña correctamente');
                }else{
                    alert('Algo ha salido mal');
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
