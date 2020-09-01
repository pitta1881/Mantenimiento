function modificarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalUpdate').text("Modificar Pedido");
    $('#updateID').attr('value', datos['id']);
    $('#nombreUsuarioUpdate').attr('value', datos['nombreUsuario']);
    $('#fechaInicioUpdate').attr('value', datos['fechaInicio']);
    $('#estadoUpdate').attr('value', datos['estado']);
    $("#idSectorUpdate option[value=" + datos['idSector'] + "]").prop('selected', true)
    $("#prioridadUpdate option[value=" + datos['prioridad'] + "]").prop('selected', true)
    $('#descripcionUpdate').val(datos['descripcion']);
    $('#modalUpdate').modal('show');
}

function eliminarModal(datos) {
    datos = JSON.parse(datos);
    $('#h3TitleModalDelete').text("Eliminar Pedido " + datos['id']);
    $('#deleteID').attr('value', datos['id']);
    $('#modalDelete').modal('show');
}

function verTareasModal(datos) {
    datos = JSON.parse(datos);
    var formattedDate = new Date(datos['fechaInicio']);
    var d = formattedDate.getDate();
    var m = formattedDate.getMonth();
    m += 1; // JavaScript months are 0-11
    var y = formattedDate.getFullYear();
    $('#verPedidoID').text(datos['id']);
    $('#verPedidoNombreUsuario').text(datos['nombreUsuario']);
    $('#verPedidoFechaInicio').text(d + "/" + m + "/" + y);
    $('#verPedidoEstado').text(datos['estado']);
    $('#verPedidoNombreSector').text(datos['nombreSector']);
    $('#verPedidoPrioridad').text(datos['prioridad']);
    $('#verPedidoDescripcion').append(datos['descripcion']);
    $('#modalTareas').modal('show');
}

function printDiv() {
    $("#modalTareas").printThis();
}