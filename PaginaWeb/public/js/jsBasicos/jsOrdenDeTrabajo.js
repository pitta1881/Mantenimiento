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
    loadEventosTableTareasNewOT();
}

function loadEventosTableTareasNewOT() {
    $(`#tableTareas .btn-agregar`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-tarea-added").toggle();
        $(`#tableTareas`).parents('form').find('button[type=submit]').attr('disabled', false);
        changeLSTareas.call(this);
    })

    $(`#tableTareas .btn-tarea-added`).on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-agregar").toggle();
        changeLSTareas.call(this);
        if (JSON.parse(localStorage.getItem('tareas')).length == 0) {
            $(`#tableTareas`).parents('form').find('button[type=submit]').attr('disabled', true);
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