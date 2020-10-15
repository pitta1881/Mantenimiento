function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Especializacion '" + datos['nombre'] + "'");
    $('#updateID').text(datos['id']).val(datos['id']);
    $('#nombreAnterior').text(datos['nombre']).val(datos['nombre']);
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Especializacion '" + datos['nombre'] + "'");
    $('#deleteID').text(datos['id']).val(datos['id']);
}