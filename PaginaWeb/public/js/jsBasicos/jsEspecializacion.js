function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Especializacion " + datos['nombre']);
    $('#updateID').text(datos['idEspecializacion']).val(datos['idEspecializacion']);
    $('#nombreAnterior').text(datos['nombre']).val(datos['nombre']);
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Especializacion " + datos['nombre']);
    $('#deleteID').text(datos['idEspecializacion']).val(datos['idEspecializacion']);
    $('#modalDelete').modal('show');
}