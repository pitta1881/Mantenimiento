function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Sector");
    $('#updateID').attr('value', datos['idSector']);
    $('#nombreSectorUpdate').attr('value', datos['nombreSector']);
    $('#responsableUpdate').attr('value', datos['responsable']);
    $('#telefonoUpdate').attr('value', datos['telefono']);
    $('#emailUpdate').attr('value', datos['email']);
    $("#tipoUpdate option[value='" + datos['tipo'] + "']").prop('selected', true)
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Sector " + datos['nombreSector']);
    $('#deleteID').attr('value', datos['idSector']);
    $('#modalDelete').modal('show');
}