function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Agente '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#updateID').attr('value', datos['id']);
    $('#nombreyape').attr('value', datos['nombre'] + " " + datos['apellido']);
    var todasEspecializaciones = $('#idEspecializacionUpd').children();
    for (let index = 0; index < todasEspecializaciones.length; index++) {
        datos['listaEspecializaciones'].forEach(element => {
            if (element['id'] == ($(todasEspecializaciones[index]).val())) {
                $(todasEspecializaciones[index]).attr('selected', 'selected');
            }
        });
    }
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Agente '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#deleteID').attr('value', datos['id']);
}