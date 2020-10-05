function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Usuario " + datos['nick']);
    $('#updateID').attr('value', datos['id']);
    $('#modalUpdate').modal('show');
}

function modificarRolesModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalRolesUpdate').text("Modificar Roles de Usuario " + datos['nick']);
    $('#updateRolIdUsuario').attr('value', datos['id']);
    var todosRoles = $('input[id^="rolChkbx_"]');
    for (let index = 0; index < todosRoles.length; index++) {
        datos['listaRoles'].forEach(element => {
            if (element['id'] == ($(todosRoles[index]).val())) {
                $(todosRoles[index]).attr('checked', 'checked');
            }
        });
        $('#modalRolesUpdate').modal('show');
    }
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Usuario " + datos['nick']);
    $('#deleteID').attr('value', datos['id']);
    $('#modalDelete').modal('show');
}