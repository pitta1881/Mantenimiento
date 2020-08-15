function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Agente");
    $('#updateID').attr('value', datos['idAgente']);
    $('#nombreyape').attr('value', datos['nombre'] + " " + datos['apellido']);
    $("#idEspecializacion option[value=" + datos['idEspecializacion'] + "]").prop('selected', true)
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Agente " + datos['nombre'] + " " + datos['apellido']);
    $('#deleteID').attr('value', datos['idAgente']);
    $('#modalDelete').modal('show');
}