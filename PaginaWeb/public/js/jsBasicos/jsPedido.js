import {
    setUrl,
    visualizarPersonaAgente,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getFichaOne,
    getPermisosRolActual,
    reloadListenerActionButtonsTableGeneral,
    getAgentesInsumos
} from '/public/js/generales/jsGeneral.js';

setUrl("/pedidos/");

loadTablePedido();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'finish': finishModal,
    'visualize': visualizarPedidoGeneral,
    'visualize-2': {
        'callback': visualizarSectorPedido,
        'url': "/administracion/sectores/"
    },
    'visualize-3': {
        'callback': visualizarPersonaAgente,
        'url': "/administracion/personas/"
    },
    'visualize-4': {
        'callback': visualizarInsumo,
        'url': "/insumos/"
    },
    'loadTable': loadTablePedido
});
loadScriptValidarCampos(loadTablePedido);
sessionStorage.clear();

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
            let btnFinish = ``;
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
            if (element.idEstado == 1 && (element.tareasAsignadas == 0 || element.tareas.every(tarea => tarea.idEstado == 4)) && permisosRolActual.some(item => item == 14)) {
                btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="delete" data-target="#modalDelete" title="Cancelar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
            }
            if (element.idEstado == 2 && element.tareas.every(tarea => tarea.idEstado == 4 || tarea.idEstado == 5)) {
                btnFinish = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="finish" data-target="#modalFinish" title="Finalizar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-check-circle fa-lg fa-fw"></i>
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
                    ${btnFinish}
                </div>
            </td>
        </tr>
        `;
        });
    }
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7,8', [9], 'Pedidos Registrados');
}

async function visualizarPedidoGeneral(datos) {
    reloadListenerActionButtonsTableGeneral();
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
    loadScriptOrdenarPagTablas('miTablaHistorial', '0,1,2,3', [], 'Historial', true, 'nav-pedido');
}

async function loadTableTareas(datos) {
    $('#miTablaTarea').DataTable().clear().destroy();
    let permisosRolActual = await getPermisosRolActual();
    let textoInner = ``;
    if (datos.idEstado == 4 || datos.idEstado == 5 || datos.idEstado == 6) {
        $('button[data-target="#modalNewTarea"]').hide();
    } else {
        $('button[data-target="#modalNewTarea"]').show();
    }
    datos.tareas.forEach(tarea => {
        let myDateInicio = tarea['fechaInicio'].split(" ");
        myDateInicio[0] = myDateInicio[0].split("-").reverse().join("/");
        let myDateFin = ['-', ''];
        let agentesHTML = '';
        let insumosHTML = '';
        let btnAsignar = ``;
        let btnDesasignar = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        if (tarea['fechaFin'] != '-') {
            myDateFin = tarea['fechaFin'].split(" ");
            myDateFin[0] = myDateFin[0].split("-").reverse().join("/");
        }
        tarea.agentes.forEach(agente => {
            agentesHTML += `<li class="text-left"><a href="#" data-abm="visualize-3" data-id=${agente.idPersona}>${agente.nombre.slice(0,1)}. ${agente.apellido}</a></li>`
        })
        tarea.insumos.forEach(insumo => {
            insumosHTML += `<li class="text-left"><a href="#" data-abm="visualize-4" data-id=${insumo.idInsumo}>${insumo.nombre.slice(0,1)}. ${insumo.descripcion}</a></li>`
        })
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 19)) {
            btnAsignar = ` 
        <button type="button" class="btn btn-outline-primary asignarAgentesInsumos" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}' data-idEspecializacion=${tarea.idEspecializacion} data-target="#modalAsignaciones" title="Asignar Agentes e Insumos" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-plus-circle fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && (permisosRolActual.some(item => item == 19) && tarea.agentes.length != 0 || tarea.insumos.length != 0)) {
            btnDesasignar = ` 
        <button type="button" class="btn btn-outline-primary desasignarAgentesInsumos" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}' data-target="#modalDesasignaciones" title="Desasignar Agentes e Insumos" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-minus-circle fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 19)) {
            btnPencil = ` 
        <button type="button" class="btn btn-outline-primary updateTarea" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}'  data-target="#modalUpdateTarea" title="Editar Tarea" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 18)) {
            btnTrash = ` 
        <button type="button" class="btn btn-outline-primary deleteTarea" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}' data-target="#modalDeleteTarea" title="Cancelar Tarea" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-trash-alt fa-lg fa-fw"></i>
        </button>
        `;
        }
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
            <td><ul class="p-0 m-0 pl-3">${agentesHTML ? agentesHTML : '-'}</ul></td>
            <td><ul class="p-0 m-0 pl-3">${insumosHTML ? insumosHTML : '-'}</ul></td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${(tarea.idEstado == 1) ?
                        btnAsignar+
                        btnDesasignar+
                        btnPencil+
                        btnTrash
                        : (tarea.idEstado == 4) ? '-':
                        `<a href="/ordendetrabajo">Orden de Trabajo Nº ${tarea.idOrdenDeTrabajo}</a>`
                    }
                </div>
            </td>            
        </tr>
        `
    });
    $('#idPedidoTarea').attr('value', datos.id).val(datos.id);
    $('#idPrioridadTarea option[value=' + datos.idPrioridad + ']').prop('selected', true);
    $('#miTablaTarea tbody').html(textoInner);
    loadHistorial(datos);
    $('.asignarAgentesInsumos').on('click', asignarAgentesInsumos);
    $('.desasignarAgentesInsumos').on('click', desasignarAgentesInsumos);
    $('.updateTarea').on('click', modificarTareaModal)
    $('.deleteTarea').on('click', deleteModalTarea)
    loadScriptOrdenarPagTablas('miTablaTarea', '0,1,2,3,4,5,6,7', [8, 9, 10], 'Tareas Registradas', true, 'nav-pedido');
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

function visualizarInsumo(datos) {
    alertify.alert("Detalles Insumo",
        `
        <strong>Nombre:</strong> ${datos.nombre}
        <br> <strong>Descripcion:</strong> ${datos.descripcion}
        <br> <strong>Medida:</strong> ${datos.medidaNombre}
        <br> <strong>Stock Actual:</strong> ${datos.stockReal}
        <br> <strong>Stock Comprometido:</strong> ${datos.stockComprometido}
        <br> <strong>Stock Futuro:</strong> ${datos.stockFuturo}
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

async function modificarTareaModal(e) {
    let btn = (e.target.closest('[data-target]'));
    let datos = await getFichaOne({
        "idPedido": btn.dataset.idpedido,
        "id": btn.dataset.idtarea
    }, "/tarea/");
    $('#formTareaUpdate #hidden-inputs').html(`
            <input type="text" name="idTarea" value="${datos['id']}" required hidden>
            <input type="text" name="idPedido" value="${datos['idPedido']}" required hidden>
            <input type="text" name="idEstado" value="${datos['idEstado']}" required hidden>
            <input type="text" name="idEspecializacion" value="${datos['idEspecializacion']}" required hidden>
    `)
    $("#idEspecializacionTareaUpd option[value=" + datos['idEspecializacion'] + "]").prop('selected', true)
    $("#idPrioridadTareaUpd option[value=" + datos['idPrioridad'] + "]").prop('selected', true)
    $('#descripcionTareaUpd').val(datos['descripcion']);
    $(btn.dataset.target).modal('show');
}

function deleteModal(datos) {
    $('#h3TitleModalDelete').text("Cancelar Pedido " + datos['id']);
    $('#deleteID').attr('value', datos['id']);
}

function finishModal(datos) {
    $('#h3TitleModalFinish').text("Finalizar Pedido " + datos['id']);
    $('#finishID').attr('value', datos['id']);
}

async function deleteModalTarea(e) {
    let btn = (e.target.closest('[data-target]'));
    let datos = await getFichaOne({
        "idPedido": btn.dataset.idpedido,
        "id": btn.dataset.idtarea
    }, "/tarea/");
    $('#deleteIDTarea').attr('value', datos['id']);
    $('#deleteIDPedido').attr('value', datos['idPedido']);
    $(btn.dataset.target).modal('show');
}

async function desasignarAgentesInsumos(e) {
    let btn = (e.target.closest('[data-target]'));
    let datosTarea = await getFichaOne({
        "idPedido": btn.dataset.idpedido,
        "id": btn.dataset.idtarea
    }, "/tarea/");
    sessionStorage.setItem('agentes', '[]');
    sessionStorage.setItem('insumos', '[]');
    $('#desasignacionIDTarea').val(btn.dataset.idtarea);
    $('#desasignacionIDPedido').val(btn.dataset.idpedido);
    $('#tableAgentesDesasignar').DataTable().clear().destroy();
    $('#tableInsumosDesasignar').DataTable().clear().destroy();
    let agentesHTML = ``;
    let insumosHTML = ``;
    let carritoItem;
    let agenteItem;

    datosTarea.insumos.forEach(element => {
        carritoItem = ``;
        carritoItem = ` 
        ${`
            <button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Editar Insumo" data-placement="top">Editar</button>
            <button type="button" class="btn btn-minus-cart btn-md btn-primary border-right-0 border"><i class="fal fa-minus"></i></button>
            <input type="number" data-name="idInsumo" value="${element.idInsumo}" hidden>
            <input type="number" data-name="cantidadInicial" value="${element.cantidad}" hidden>
            <input type="number" data-name="cantidadInsumo" class="input-cart" placeholder="0" value="0" min="0" max="${element.cantidad}" readonly>
            <button type="button" class="btn btn-plus-cart btn-primary border-left-0 border"><i class="fal fa-plus"></i></button>
            `}`;
        insumosHTML += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.cantidad}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${carritoItem}
                </div>
            </td>
        </tr>
        `;
    });

    datosTarea.agentes.forEach(element => {
        agenteItem = ``;
        agenteItem = `
                <button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Seleccionar Agente" data-placement="top">Eliminar</button>
                <input type="number" data-name="idAgente" value="${element.idAgente}" hidden>
                <button type="button" class="btn btn-sm btn-outline-danger m-auto btn-agente-added" data-toggle="tooltip" title="Seleccionado" data-placement="top"><i class="fal fa-check-circle fa-lg"></i></button>
                `;
        agentesHTML += `
        <tr>
            <td>${element.idPersona}</td>
            <td>${element.nombre + ' ' + element.apellido}</td>
            <td>
                <div class="float-none" role="group">
                    ${agenteItem}
                </div>
            </td>
        </tr>
        `;
    });

    $('#tableAgentesDesasignar tbody').html(agentesHTML);
    $('#tableInsumosDesasignar tbody').html(insumosHTML);
    loadScriptOrdenarPagTablas('tableAgentesDesasignar', '0,1', [2], 'Agentes Registrados', false);
    loadScriptOrdenarPagTablas('tableInsumosDesasignar', '0,1,2', [3], 'Insumos Registrados', false);
    loadEventosTableAgentes('tableAgentesDesasignar');
    loadEventosTableInsumos('tableInsumosDesasignar');
    $(btn.dataset.target).modal('show');
};

async function asignarAgentesInsumos(e) {
    let datosDisponibles = await getAgentesInsumos();
    sessionStorage.setItem('agentes', '[]');
    sessionStorage.setItem('insumos', '[]');
    let btn = (e.target.closest('[data-target]'));
    $('#asignacionIDTarea').val(btn.dataset.idtarea);
    $('#asignacionIDPedido').val(btn.dataset.idpedido);
    $('#tableAgentesAsignar').DataTable().clear().destroy();
    $('#tableInsumosAsignar').DataTable().clear().destroy();
    let agentesHTML = ``;
    let insumosHTML = ``;
    let carritoItem;
    let agenteItem;

    datosDisponibles.insumos.forEach(element => {
        carritoItem = ``;
        carritoItem = ` 
        ${
           element.listaTareas.some((element) => element.idTarea == btn.dataset.idtarea && element.idPedido == btn.dataset.idpedido) 
                ? `<a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Insumo ya asignado a ésta Tarea" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
                :
            (Number(element.stockReal - element.stockComprometido) <= 0 
            ? `<a class="btn btn-danger" data-toggle="tooltip" title="Sin Stock" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
            : `
            <button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Seleccionar Insumo" data-placement="top">Agregar</button>
            <button type="button" class="btn btn-minus-cart btn-md btn-primary border-right-0 border"><i class="fal fa-minus"></i></button>
            <input type="number" data-name="idInsumo" value="${element.id}" hidden>
            <input type="number" data-name="cantidadInsumo" class="input-cart" placeholder="0" value="0" min="0" max="${element.stockReal - element.stockComprometido}" readonly>
            <button type="button" class="btn btn-plus-cart btn-primary border-left-0 border"><i class="fal fa-plus"></i></button>
            `)}`;
        insumosHTML += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.stockReal - element.stockComprometido}</td>
            <td>${element.medidaNombre}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${carritoItem}
                </div>
            </td>
        </tr>
        `;
    });

    datosDisponibles.agentes.forEach(element => {
        if (element.listaEspecializaciones.some(esp => esp.id == btn.dataset.idespecializacion) && element.idEstadoPersona != 2) {
            agenteItem = ``;
            let especializacionHTML = ``;
            element.listaEspecializaciones.forEach(especializacion => {
                especializacionHTML += `${especializacion.nombre}<br>`
            })
            agenteItem = ` 
        ${  element.listaTareas.some((element) => element.idTarea == btn.dataset.idtarea && element.idPedido == btn.dataset.idpedido) 
            ? `<a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Agente ya asignado a ésta Tarea" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
            : 
                (Number(element.tareasActuales) >= 10 
                ? `<a class="btn btn-danger" data-toggle="tooltip" title="Agente con demasiadas tareas actuales" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
                : 
                Number(element.idEstadoPersona == 3)
                ? `<a class="btn btn-danger" data-toggle="tooltip" title="Agente con licencia" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
                : `<button type="button" class="btn btn-sm btn-outline-primary btn-agregar" data-toggle="tooltip" title="Seleccionar Agente" data-placement="top">Agregar</button>
                <input type="number" data-name="idAgente" value="${element.id}" hidden>
                <button type="button" class="btn btn-sm btn-outline-success m-auto btn-agente-added" data-toggle="tooltip" title="Seleccionado" data-placement="top"><i class="fal fa-check-circle fa-lg"></i></button>`
        )}`;
            agentesHTML += `
        <tr>
            <td>${element.idPersona}</td>
            <td>${element.nombre + ' ' + element.apellido}</td>
            <td>${especializacionHTML}</td>
            <td>
                <div class="float-none" role="group">
                    ${agenteItem}
                </div>
            </td>
        </tr>
        `;
        }
    });

    $('#tableAgentesAsignar tbody').html(agentesHTML);
    $('#tableInsumosAsignar tbody').html(insumosHTML);
    loadScriptOrdenarPagTablas('tableAgentesAsignar', '0,1,2', [3], 'Agentes Registrados', false);
    loadScriptOrdenarPagTablas('tableInsumosAsignar', '0,1,2,3', [4], 'Insumos Registrados', false);
    loadEventosTableAgentes('tableAgentesAsignar');
    loadEventosTableInsumos('tableInsumosAsignar');
    $(btn.dataset.target).modal('show');
};

function loadEventosTableAgentes(idTable) {
    $(`#${idTable} .btn-agregar`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-agente-added").toggle();
        $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', false);
        changeLSAgentes.call(this);
    })

    $(`#${idTable} .btn-agente-added`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-agregar").toggle();
        changeLSAgentes.call(this);
        if (JSON.parse(sessionStorage.getItem('agentes')).length == 0 && JSON.parse(sessionStorage.getItem('insumos')).length == 0) {
            $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', true);
        }
    })

    function changeLSAgentes() {
        let agentes = JSON.parse(sessionStorage.getItem('agentes')) || [];
        let idAgenteElegido = $(this).siblings('[data-name=idAgente]').val();
        let agenteToChange = {
            'id': idAgenteElegido
        }
        let indexAgenteLocal = agentes.findIndex(element => element.id == idAgenteElegido);
        if (indexAgenteLocal >= 0) {
            agentes.splice(indexAgenteLocal, 1);
        } else {
            agentes.push(agenteToChange);
        }
        sessionStorage.setItem('agentes', JSON.stringify(agentes));
    }
}

function loadEventosTableInsumos(idTable) {
    $(`#${idTable} .btn-agregar`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-minus-cart, .input-cart, .btn-plus-cart").toggle();
        let inputCart = $(this).siblings('.input-cart');
        inputCart.val(1);
        if (inputCart.prop("max") == inputCart.val()) {
            $(this).siblings('.btn-plus-cart').attr('disabled', true);
        }
        $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', false);
        changeLSInsumo.call(this);
    })

    $(".btn-minus-cart").on("click", function () {
        let inputCart = $(this).siblings('.input-cart');
        $(this).siblings('.btn-plus-cart').attr('disabled', false);
        if (inputCart.val() == 1) {
            $(this).toggle();
            $(this).siblings(`#${idTable} .btn-agregar, .input-cart, .btn-plus-cart`).toggle();
        }
        inputCart.val(Number(inputCart.val()) - 1);
        changeLSInsumo.call(this);
        if (JSON.parse(sessionStorage.getItem('agentes')).length == 0 && JSON.parse(sessionStorage.getItem('insumos')).length == 0) {
            $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', true);
        }
    })

    $(".btn-plus-cart").on("click", function () {
        let inputCart = $(this).siblings('.input-cart');
        inputCart.val(Number(inputCart.val()) + 1);
        if (inputCart.prop("max") == inputCart.val()) {
            $(this).attr('disabled', true);
        }
        changeLSInsumo.call(this);
    })

    function changeLSInsumo() {
        let insumos = JSON.parse(sessionStorage.getItem('insumos')) || [];
        let idInsumoElegido = $(this).siblings('[data-name=idInsumo]').val();
        let cantidadInicial = $(this).siblings('[data-name=cantidadInicial]').val();
        let cantidadInsumoElegido = $(this).siblings('[data-name=cantidadInsumo]').val();
        let insumoToChange = {
            'id': idInsumoElegido,
            'cantidadInicial': cantidadInicial,
            'cantidad': cantidadInsumoElegido
        }
        let indexInsumoLocal = insumos.findIndex(element => element.id == idInsumoElegido);
        if (indexInsumoLocal >= 0) {
            if (cantidadInsumoElegido == 0) {
                insumos.splice(indexInsumoLocal, 1);
            } else {
                insumos[indexInsumoLocal].cantidad = cantidadInsumoElegido
            }
        } else {
            insumos.push(insumoToChange);
        }
        sessionStorage.setItem('insumos', JSON.stringify(insumos));
    }
}