function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Contraseña de '" + datos['nick'] + "'");
    $('#updateID').attr('value', datos['id']);
}

function modificarRolesModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalRolesUpdate').text("Modificar Roles de '" + datos['nick'] + "'");
    $('#updateRolIdUsuario').attr('value', datos['id']);
    var todosRoles = $('#idRolUpd').children();
    for (let index = 0; index < todosRoles.length; index++) {
        datos['listaRoles'].forEach(element => {
            if (element['id'] == ($(todosRoles[index]).val())) {
                $(todosRoles[index]).attr('selected', 'selected');
            }
        });
    }
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Usuario '" + datos['nick'] + "'");
    $('#deleteID').attr('value', datos['id']);
}