function fichaSector(idSector) {
    var parametros = {
        "id": idSector,
    };
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/administracion/sectores/fichaSector', //archivo que recibe la peticion
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