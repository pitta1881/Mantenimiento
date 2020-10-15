function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Permiso " + datos['nombre']);
    $('#deleteID').attr('value', datos['id']);
}