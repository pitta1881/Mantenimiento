import {
    setUrl,
    setUrlAjax,
    setUrlAjax2,
    visualizarPersonaAgente,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaOne,
    getFichaAll,
    getPermisosRolActual
} from '/public/js/generales/jsGeneral.js';

setUrl("/pedidos/");
setUrlAjax("/administracion/sectores/");
setUrlAjax2("/administracion/personas/");

loadTablePedido();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize': visualizarPedidoGeneral,
    'visualize-2': visualizarSectorPedido,
    'visualize-3': visualizarPersonaAgente,
    'loadTable': loadTablePedido
});
loadScriptValidarCampos(loadTablePedido, loadTableTareas);

//--PEDIDOS--\\
async function loadTablePedido() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    if (fichaAll.length > 0) {
        fichaAll.forEach(element => {
            let disabled = ``;
            let btnEye = ``;
            let btnPencil = ``;
            let btnTrash = ``;
            (element.usado || element.id == 1 ? disabled = `disabled` : ``);
            if (permisosRolActual.some(item => item == 16)) {
                btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="visualize" data-target="#modalGeneral" title="Ver Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
            }
            if (element.idEstado != 4 && element.idEstado != 5 && permisosRolActual.some(item => item == 15)) {
                btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="update" data-target="#modalUpdate" title="Editar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
            }
            if (element.idEstado == 1 && element.tareasAsignadas == 0 && permisosRolActual.some(item => item == 14)) {
                btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="delete" data-target="#modalDelete" title="Cancelar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
            }
            textoInner += `
        <tr>
            <th scope="row">${element.id}</th>
            <td>${element.descripcion}</td>
            <td>
                <a href="#" data-abm="visualize-2" data-id='${element.idSector}'>${element.sectorNombre}</a>
            </td>
            <td>${element.fechaInicio}</td>
            <td>${element.fechaFin}</td>
            <td>${element.tareasAsignadas}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.prioridadNombre}</td>
            <td>${element.nickUsuario}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                    ${btnPencil}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
        });
    }
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7,8', [9], 'Pedidos Registrados');
}

function visualizarPedidoGeneral(datos) {
    loadDlPedido(datos);
    loadTableTareas(datos);
}

function loadDlPedido(datos) {
    let textoInner = ``;
    textoInner += `
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Nº Pedido</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.id}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Descripcion</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.descripcion}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Sector</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.sectorNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Inicio</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaInicio}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Fin</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaFin}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Tareas</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.tareasAsignadas}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Estado</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.estadoNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Prioridad</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.prioridadNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Usuario</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.nickUsuario}</dd>
            `;
    document.getElementById('dlPedido').innerHTML = textoInner;
}

function loadHistorial(datos) {
    $('#miTablaHistorial').DataTable().clear().destroy();
    let textoInner = ``;
    datos.historial.forEach(element => {
        let myDate = element['fecha'].split(" ");
        myDate[0] = myDate[0].split("-").reverse().join("/");
        textoInner += `
        <tr>
            <th scope="row">${element.id}</th>
            <td>${myDate[0]} ${myDate[1]}</td>
            <td>${element.nickUsuario}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.observacion}</td>
        </tr>
            `
    });
    $('#miTablaHistorial tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTablaHistorial', '0,1,2,3', [], 'Historial');
}

async function loadTableTareas(datos) {
    if (Number.isInteger(datos)) {
        datos = await getFichaOne(datos, url);
    }
    $('#miTablaTarea').DataTable().clear().destroy();
    let textoInner = ``;
    if (datos.idEstado == 4 || datos.idEstado == 6) {
        $('button[data-target="#modalNewTarea"]').hide();
    } else {
        $('button[data-target="#modalNewTarea"]').show();
    }
    datos.tareas.forEach(tarea => {
        let myDateInicio = tarea['fechaInicio'].split(" ");
        myDateInicio[0] = myDateInicio[0].split("-").reverse().join("/");
        let myDateFin = ['-', ''];
        if (tarea['fechaFin'] != '-') {
            myDateFin = tarea['fechaFin'].split(" ");
            myDateFin[0] = myDateFin[0].split("-").reverse().join("/");
        }
        let agentesHTML = '';
        tarea.agentes.forEach(agente => {
            agentesHTML += `<a href="#" data-abm="visualize-3" data-id=${agente.id}>${agente.nombre} ${agente.apellido}</a><br>`
        })
        textoInner += `
        <tr>
            <th scope="row">${tarea.id}</th>
            <td>${myDateInicio[0]} ${myDateInicio[1]}</td>
            <td>${myDateFin[0]} ${myDateFin[1]}</td>
            <td>${tarea.descripcion}</td>
            <td>${tarea.especializacionNombre}</td>
            <td>${tarea.prioridadNombre}</td>
            <td>${tarea.estadoNombre}</td>
            <td>${tarea.nickUsuario}</td>
            <td>${agentesHTML}</td>
            
        </tr>
        `
    });
    $('#idPedidoTarea').attr('value', datos.id).val(datos.id);
    $('#idPrioridadTarea option[value=' + datos.idPrioridad + ']').prop('selected', true);
    $('#miTablaTarea tbody').html(textoInner);
    loadHistorial(datos);
    loadScriptOrdenarPagTablas('miTablaTarea', '0,1,2,3,4,5,6,7,8', [], 'Tareas Registradas');
}

function visualizarSectorPedido(datos) {
    alertify.alert("Detalles Sector",
        `
        <strong>Nombre:</strong> ${datos.nombre}
        <br> <strong>Responsable:</strong> ${datos.responsable}
        <br> <strong>Tipo:</strong> ${datos.tipoSectorNombre}
        <br> <strong>Email:</strong> ${datos.email}
        <br> <strong>Telefono:</strong> ${datos.telefono}
        `
    );

}

function modificarModal(datos) {
    var myDate = datos['fechaInicio'].split(" ");
    myDate = myDate[0].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Pedido " + datos['id']);
    $('#updateID').attr('value', datos['id']);
    $('#idUsuarioUpdate').attr('value', datos['idUsuario']).val(datos['nickUsuario']);
    $('#fechaInicioUpdate').attr('value', myDate).val(myDate);
    $('#idEstadoUpdateHid').attr('value', datos['idEstado']).val(datos['idEstado']);
    $('#idEstadoUpdate').attr('value', datos['estadoNombre']).val(datos['estadoNombre']);
    $("#idSectorUpdate option[value=" + datos['idSector'] + "]").prop('selected', true)
    $("#idPrioridadUpdate option[value=" + datos['idPrioridad'] + "]").prop('selected', true)
    $('#descripcionUpdate').val(datos['descripcion']);
}

function deleteModal(datos) {
    $('#h3TitleModalDelete').text("Cancelar Pedido " + datos['id']);
    $('#deleteID').attr('value', datos['id']);
}