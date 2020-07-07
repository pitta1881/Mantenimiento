function fichaSector(valor1) {
    var parametros = {
        "idSector": valor1,
    };
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/fichaSector', //archivo que recibe la peticion
        type: 'post', //método de envio
        success: function (
            response
        ) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            var miSector = JSON.parse(response);
            alertify.alert("Detalles Sector",
                "<strong>Nombre:</strong> " + miSector.nombreSector +
                "<br> <strong>Responsable:</strong> " + miSector.responsable +
                "<br> <strong>Tipo:</strong> " + miSector.tipo +
                "<br> <strong>Email:</strong> " + miSector.email +
                "<br> <strong>Telefono:</strong> " + miSector.telefono
            );
        }
    });
}

function fichaPersona(valor1) {
    var parametros = {
        "idAgente": valor1,
    };
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/fichaPersona', //archivo que recibe la peticion
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
        }
    });
}