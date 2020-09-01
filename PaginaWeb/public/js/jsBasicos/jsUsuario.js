function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Usuario " + datos['nombre']);
    $('#updateID').attr('value', datos['nombre']);
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Usuario " + datos['nombre']);
    $('#deleteID').attr('value', datos['nombre']);
    $('#modalDelete').modal('show');
}