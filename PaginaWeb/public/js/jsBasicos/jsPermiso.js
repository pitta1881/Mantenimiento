function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['idPermiso']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombrePermiso']);
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Permiso " + datos['nombrePermiso']);
    $('#deleteID').attr('value', datos['idPermiso']);
    $('#modalDelete').modal('show');
}