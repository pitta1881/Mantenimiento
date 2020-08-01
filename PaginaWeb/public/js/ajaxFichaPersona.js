function fichaPersona(dni) {
    var parametros = {
        "dni": dni,
    };
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/administracion/personas/fichaPersona', //archivo que recibe la peticion
        type: 'post', //método de envio
        success: function (
            response
        ) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            var miPersona = JSON.parse(response);
            alertify.alert("Detalles Persona",
                "<strong>DNI:</strong> " + miPersona.dni +
                "<br> <strong>Nombre y Apellido:</strong> " + miPersona.nombre + " " + miPersona.apellido +
                "<br> <strong>Fecha de Nacimiento:</strong> " + miPersona.fecha_nacimiento +
                "<br> <strong>Direccion:</strong> " + miPersona.direccion +
                "<br> <strong>Email:</strong> " + miPersona.email
            );
        },
        error: function (response) {

        },



    });
}