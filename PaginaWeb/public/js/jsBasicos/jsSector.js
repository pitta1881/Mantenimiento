function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Sector '" + datos['nombre'] + "'");
    $('#updateID').attr('value', datos['id']);
    $('#nombreUpdate').attr('value', datos['nombre']);
    $('#responsableUpdate').attr('value', datos['responsable']);
    $('#telefonoUpdate').attr('value', datos['telefono']);
    $('#emailUpdate').attr('value', datos['email']);
    $("#idTipoSectorUpd option[value='" + datos['idTipoSector'] + "']").prop('selected', true)
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Sector '" + datos['nombre'] + "'");
    $('#deleteID').attr('value', datos['id']);
}