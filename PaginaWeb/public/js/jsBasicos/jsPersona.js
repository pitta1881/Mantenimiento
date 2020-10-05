function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Persona " + datos['nombre'] + " " + datos['apellido']);
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
    $('#apellidoAnteriorUpdate').attr('value', datos['apellido']);
    $('#direccionAnteriorUpdate').attr('value', datos['direccion']);
    $('#emailAnteriorUpdate').attr('value', datos['email']);
    $('#fechaAnteriorUpdate').attr('value', datos['fecha_nacimiento']);
    $('#modalUpdate').modal('show');
}

function modificarEstadoModal(datos) {
    datos = JSON.parse(datos);
    $('#updateEstadoID').attr('value', datos['id']);
    $("#estadoUpdate option[value=" + datos['estado'] + "]").remove();
    $('#modalEstadoUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Persona " + datos['nombre'] + " " + datos['apellido']);
    $('#deleteID').attr('value', datos['id']);
    $('#modalDelete').modal('show');
}