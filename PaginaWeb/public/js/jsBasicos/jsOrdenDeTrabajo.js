import {
    setUrl,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
    getTareasSinOT,
    getFichaOne,
} from '/public/js/generales/jsGeneral.js';

setUrl("/ordendetrabajo/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'visualize': visualizarOTParticular,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);
localStorage.clear();

$(function () {
    $('#btnCreateOT').on('click', function () {
        loadTableTareasNewOT();
        $(this.dataset.target).modal('show');
    })
})

//--ORDEN DE TRABAJO--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let btnEye = ``;
        if (permisosRolActual.some(item => item == 24)) {
            btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-abm="visualize" data-id='${element.id}' data-target="#modalGeneral" data-toggle="tooltip" title="Mas Detalles" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
        }
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.fechaInicio}</td>
            <td>${element.fechaFin}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.cantidadTareas}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4', [5], 'Ordenes de Trabajo Registrados');
}

async function loadTableTareasNewOT() {
    $(`#tableTareas`).parents('form').find('button[type=submit]').attr('disabled', true);
    let tareasSinOT = await getTareasSinOT();
    $('#tableTareas').DataTable().clear().destroy();
    localStorage.setItem('tareas', '[]');
    let textoInner = ``;
    tareasSinOT.tareas.forEach(element => {
        let agentesHTML = '';
        let insumosHTML = '';
        let addItem = ``;

        element.agentes.forEach(agente => {
            agentesHTML += `<li class="text-left">${agente.nombre.slice(0,1)}. ${agente.apellido}</li>`
        })
        element.insumos.forEach(insumo => {
            insumosHTML += `<li class="text-left">${insumo.nombre.slice(0,1)}. ${insumo.descripcion}</li>`
        })
        addItem = ` 
        ${  (element.agentes.length == 0) 
            ? `<a href="/pedidos" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Debe asginar al menos un Agente a esta Tarea" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
                : `<button type="button" class="btn btn-sm btn-outline-primary btn-agregar" data-toggle="tooltip" title="Agregar Tarea" data-placement="top">Agregar</button>
                <input type="number" data-name="idTarea" value="${element.id}" hidden>
                <input type="number" data-name="idPedido" value="${element.idPedido}" hidden>
                <button type="button" class="btn btn-sm btn-outline-success m-auto btn-tarea-added" data-toggle="tooltip" title="Agregado" data-placement="top"><i class="fal fa-check-circle fa-lg"></i></button>`
        }`;
        textoInner += `
        <tr>
            <td>${element.idPedido}</td>
            <td>${element.id}</td>
            <td>${element.descripcion}</td>
            <td>${element.sectorNombre}</td>
            <td>${element.especializacionNombre}</td>
            <td>${element.prioridadNombre}</td>
            <td><ul class="p-0 m-0 pl-3">${agentesHTML ? agentesHTML : '-'}</ul></td>
            <td><ul class="p-0 m-0 pl-3">${insumosHTML ? insumosHTML : '-'}</ul></td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${addItem}
                </div>
            </td>
        </tr>
        `;
    });
    $('#tableTareas tbody').html(textoInner);
    loadScriptOrdenarPagTablas('tableTareas', '0,1,2,3,4,5', [6, 7, 8], 'Tareas Registradas', false);
    loadEventosTableTareas('tableTareas');
}

function loadEventosTableTareas(idTable) {
    $(`#${idTable} .btn-agregar`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-tarea-added").toggle();
        $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', false);
        changeLSTareas.call(this);
    })

    $(`#${idTable} .btn-tarea-added`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-agregar").toggle();
        changeLSTareas.call(this);
        if (JSON.parse(localStorage.getItem('tareas')).length == 0) {
            $(`#${idTable}`).parents('form').find('button[type=submit]').attr('disabled', true);
        }
    })

    function changeLSTareas() {
        let tareas = JSON.parse(localStorage.getItem('tareas')) || [];
        let idTareaElegida = $(this).siblings('[data-name=idTarea]').val();
        let idPedidoElegida = $(this).siblings('[data-name=idPedido]').val();
        let tareaToSelect = {
            'idTarea': idTareaElegida,
            'idPedido': idPedidoElegida
        }
        let indexTareaLocal = tareas.findIndex(element => element.idPedido == idPedidoElegida && element.idTarea == idTareaElegida);
        if (indexTareaLocal >= 0) {
            tareas.splice(indexTareaLocal, 1);
        } else {
            tareas.push(tareaToSelect);
        }
        localStorage.setItem('tareas', JSON.stringify(tareas));
    }
}

function loadTableTareasOT(table, datos) {
    $(`#${table}`).parents('form').find('button[type=submit]').attr('disabled', true);
    $('#' + table).DataTable().clear().destroy();
    localStorage.setItem('tareas', '[]');
    let textoInner = ``;
    datos.tareas.forEach(tarea => {
        let agentesHTML = '';
        let insumosHTML = '';
        tarea.agentes.forEach(agente => {
            agentesHTML += `<li class="text-left">${agente.nombre.slice(0,1)}. ${agente.apellido}</li>`
        })
        tarea.insumos.forEach(insumo => {
            insumosHTML += `<li class="text-left">${insumo.nombre.slice(0,1)}. ${insumo.descripcion}</li>`
        })
        textoInner += `
        <tr>
            <td>${tarea.idPedido}</td>
            <td>${tarea.id}</td>
            <td>${tarea.descripcion}</td>
            <td>${tarea.sectorNombre}</td>
            <td>${tarea.prioridadNombre}</td>
            <td>${tarea.estadoNombre}</td>
            <td><ul class="p-0 m-0 pl-3">${agentesHTML ? agentesHTML : '-'}</ul></td>
            <td><ul class="p-0 m-0 pl-3">${insumosHTML ? insumosHTML : '-'}</ul></td>
            ${(table === 'miTablaListaTareas' ? '': `<td>` +
            (tarea.idEstado == 1 || tarea.idEstado == 2 ? 
                `<button type="button" class="btn btn-sm btn-outline-primary btn-agregar" data-toggle="tooltip" title="Marcar Tarea Terminada" data-placement="top">Terminado</button>
                <input type="number" data-name="idTarea" value="${tarea.id}" hidden>
                <input type="number" data-name="idPedido" value="${tarea.idPedido}" hidden>
                <button type="button" class="btn btn-sm btn-outline-success m-auto btn-tarea-added" data-toggle="tooltip" title="Agregado" data-placement="top"><i class="fal fa-check-circle fa-lg"></i></button>
            `: `-`) + `</td>`
            )}
            
        </tr>
        `
    });
    $('#' + table + ' tbody').html(textoInner);
    $('input#idOTUpdateTarea').val(datos.id);
    (table === 'miTablaListaTareas' ? loadScriptOrdenarPagTablas(table, '0,1,2,3,4,5', [6, 7], 'Tareas Asignadas', true, 'dlOrdenDeTrabajo') : loadScriptOrdenarPagTablas(table, '0,1,2,3,4,5', [6, 7, 8], 'Lista de Tareas', false))
    loadEventosTableTareas('miTablaListaTareasUpd');
}

function visualizarOTParticular(datos) {
    $('#nav-ordendetrabajo-tab').click();
    loadDlOrdenDeTrabajo(datos);
    (datos.idEstado == 5 ? $('#nav-listaTareasUpd-tab').hide() : (
        $('#nav-listaTareasUpd-tab').show(),
        loadTableTareasOT('miTablaListaTareasUpd', datos)
    ));
}

function loadDlOrdenDeTrabajo(datos) {
    let textoInner = ``;
    textoInner += `
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Nº OT</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.id}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Inicio</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaInicio}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Fin</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaFin}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Cant. Tareas</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.cantidadTareas}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Estado</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.estadoNombre}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Usuario</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.nickUsuario}</dd>
    </div>
    <div class="row m-0">
            `;
    document.getElementById('dlOrdenDeTrabajo').innerHTML = textoInner;
    loadTableTareasOT('miTablaListaTareas', datos)
}