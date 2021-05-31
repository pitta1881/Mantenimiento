import {
    setUrl,
    visualizarPersonaAgente,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
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
    'updateTarea': {
        'callback': modificarTareaModal,
        'url': "/tarea/"
    },
    'delete': deleteModal,
    'deleteTarea': {
        'callback': deleteModalTarea,
        'url': "/tarea/"
    },
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
localStorage.clear();

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
    if (datos.idEstado == 4 || datos.idEstado == 6) {
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
            agentesHTML += `<a href="#" data-abm="visualize-3" data-id=${agente.idPersona}>${agente.nombre.slice(0,1)}. ${agente.apellido}</a><br>`
        })
        tarea.insumos.forEach(insumo => {
            insumosHTML += `<a href="#" data-abm="visualize-4" data-id=${insumo.idInsumo}>${insumo.nombre}</a><br>`
        })
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 19)) {
            btnAsignar = ` 
        <button type="button" class="btn btn-outline-primary asignarAgentesInsumos" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}' data-target="#modalAsignaciones" title="Asignar Agentes e Insumos" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-plus-circle fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 19) && tarea.agentes.length != 0 || tarea.insumos.length != 0) {
            btnDesasignar = ` 
        <button type="button" class="btn btn-outline-primary desasignarAgentesInsumos" data-idTarea='${tarea.id}' data-idPedido='${tarea.idPedido}' data-target="#modalDesasignaciones" title="Desasignar Agentes e Insumos" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-minus-circle fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 19)) {
            btnPencil = ` 
        <button type="button" class="btn btn-outline-primary" data-id='${tarea.id}' data-abm="updateTarea" data-target="#modalUpdateTarea" title="Editar Tarea" data-toggle="tooltip" data-placement="top">
            <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
        </button>`;
        }
        if (tarea.idEstado == 1 && permisosRolActual.some(item => item == 18)) {
            btnTrash = ` 
        <button type="button" class="btn btn-outline-primary" data-id='${tarea.id}' data-abm="deleteTarea" data-target="#modalDeleteTarea" title="Cancelar Tarea" data-toggle="tooltip" data-placement="top">
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
            <td>${agentesHTML ? agentesHTML : '-'}</td>
            <td>${insumosHTML ? insumosHTML : '-'}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnAsignar}    
                    ${btnDesasignar}    
                    ${btnPencil}
                    ${btnTrash}
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
    loadScriptOrdenarPagTablas('miTablaTarea', '0,1,2,3,4,5,6,7,8', [], 'Tareas Registradas', true, 'nav-pedido');
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

function modificarTareaModal(datos) {
    $('#formTareaUpdate #hidden-inputs').html(`
            <input type="text" name="idTarea" value="${datos['id']}" required hidden>
            <input type="text" name="idPedido" value="${datos['idPedido']}" required hidden>
            <input type="text" name="idEstado" value="${datos['idEstado']}" required hidden>
            <input type="text" name="idEspecializacion" value="${datos['idEspecializacion']}" required hidden>
    `)
    $("#idEspecializacionTareaUpd option[value=" + datos['idEspecializacion'] + "]").prop('selected', true)
    $("#idPrioridadTareaUpd option[value=" + datos['idPrioridad'] + "]").prop('selected', true)
    $('#descripcionTareaUpd').val(datos['descripcion']);
}

function deleteModal(datos) {
    $('#h3TitleModalDelete').text("Cancelar Pedido " + datos['id']);
    $('#deleteID').attr('value', datos['id']);
}

function deleteModalTarea(datos) {
    $('#deleteIDTarea').attr('value', datos['id']);
    $('#deleteIDPedido').attr('value', datos['idPedido']);
}

async function asignarAgentesInsumos(e) {
    let datosDisponibles = await getAgentesInsumos();
    let btn = (e.target.closest('[data-target]'));
    $(btn.dataset.target).modal('show');
    $('#tableAgentes').DataTable().clear().destroy();
    $('#tableInsumos').DataTable().clear().destroy();
    let agentesHTML = ``;
    let insumosHTML = ``;

    datosDisponibles.insumos.forEach(element => {
        let carritoItem = ``;
        carritoItem = ` 
        ${(Number(element.stockReal) <= 0 
            ? `<a class="btn btn-danger" data-toggle="tooltip" title="Sin Stock" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
            : `
            <button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Agregar Insumo" data-placement="top">Agregar</button>
            <button type="button" class="btn btn-minus-cart btn-md btn-primary border-right-0 border"><i class="fal fa-minus"></i></button>
            <input type="number" data-name="idInsumo" value="${element.id}" hidden>
            <input type="text" data-name="nombre" value="${element.nombre} ${element.descripcion}" hidden>
            <input type="number" data-name="cantidadInsumo" class="input-cart" placeholder="0" value="0" min="0" max="${element.stockReal}" readonly>
            <button type="button" class="btn btn-plus-cart btn-primary border-left-0 border"><i class="fal fa-plus"></i></button>
            `)}`;
        insumosHTML += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.stockReal}</td>
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
        let agenteItem = ``;
        let especializacionHTML = ``;
        element.listaEspecializaciones.forEach(especializacion => {
            especializacionHTML += `${especializacion.nombre}<br>`
        })
        agenteItem = ` 
        ${  element.listaTareas.some((element) => element.idTarea == btn.dataset.idtarea && element.idPedido == btn.dataset.idpedido) 
            ? `<a class="btn btn-warning" data-toggle="tooltip" title="Agente ya asignado a ésta Tarea" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
            : 
                (Number(element.tareasActuales) >= 10 
                ? `<a class="btn btn-danger" data-toggle="tooltip" title="Agente con demasiadas tareas actuales" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` 
                : `<button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Agregar Agente" data-placement="top">Agregar</button>`
        )}`;
        agentesHTML += `
        <tr>
            <td>${element.idPersona}</td>
            <td>${element.nombre + ' ' + element.apellido}</td>
            <td>${especializacionHTML}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${agenteItem}
                </div>
            </td>
        </tr>
        `;
    });

    $('#tableAgentes tbody').html(agentesHTML);
    $('#tableInsumos tbody').html(insumosHTML);
    loadScriptOrdenarPagTablas('tableAgentes', '0,1,2', [3], 'Agentes Registrados', false);
    loadScriptOrdenarPagTablas('tableInsumos', '0,1,2,3', [4], 'Insumos Registrados', false);
    loadEventosTableInsumos();
};

function loadEventosTableInsumos() {
    $("#tableInsumos .btn-agregar").on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-minus-cart, .input-cart, .btn-plus-cart").toggle();
        let inputCart = $(this).siblings('.input-cart');
        $('#radioInsumoChk').prop('checked', true).change();
        inputCart.val(1);
        changeLSInsumo.call(this);
    })

    $(".btn-minus-cart").on("click", function () {
        let inputCart = $(this).siblings('.input-cart');
        $(this).siblings('.btn-plus-cart').attr('disabled', false);
        if (inputCart.val() == 1) {
            $(this).toggle();
            $(this).siblings("#tableInsumos .btn-agregar, .input-cart, .btn-plus-cart").toggle();
        }
        inputCart.val(Number(inputCart.val()) - 1);
        if ($('.input-cart').filter(function () {
                return parseInt($(this).val(), 10) > 0;
            }).length == 0) {
            $('#radioInsumoChk').prop('checked', false).change();
        }
        changeLSInsumo.call(this);
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
        let insumos = JSON.parse(localStorage.getItem('insumos')) || [];
        let idInsumoElegido = $(this).siblings('[data-name=idInsumo]').val();
        let nombreInsumoElegido = $(this).siblings('[data-name=nombre]').val();
        let cantidadInsumoElegido = $(this).siblings('[data-name=cantidadInsumo]').val();
        let insumoToChange = {
            'id': idInsumoElegido,
            'nombre': nombreInsumoElegido,
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
        localStorage.setItem('insumos', JSON.stringify(insumos));
    }
}