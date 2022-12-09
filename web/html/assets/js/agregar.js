jQuery(document).on('submit', '#agregar', function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'agregar.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){

        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.error){
            if(respuesta.status == "Activo"){
                alert('Cuenta creada con éxito! Se ha enviado un correo electronico al usuario de esta cuenta');
                setTimeout(function(){
                    location.href = 'users.php';
                },500)
            }else
                alert('Algo ha salido mal, intentelo más tarde');
        }else{
            if(respuesta.tipo == "existe"){
                alert('El correo electronico ya ha sido registrado');
            }else if(respuesta.tipo == "no igual"){
                alert('Debe repetir la contraseña correctamente');
            }
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log();
    });
});