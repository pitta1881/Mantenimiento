import {
    setUrl,
    visualizarPersonaAgente as visualizarModal,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaOne,
    getFichaAll,
    getPermisosRolActual,
    modalGenDelete
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/agentes/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize-2': {
        'callback': visualizarModal,
        'url': "/administracion/personas/"
    },
    'tareasActuales': loadTareasActuales,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);

//--AGENTE--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let especializacionHTML = ``;
        let btnEye = ``;
        let btnList = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        (element.usado ? disabled = `disabled` : ``);
        element.listaEspecializaciones.forEach(especializacion => {
            especializacionHTML += `${especializacion.nombre}<br>`
        })
        if (permisosRolActual.some(item => item == 32)) {
            btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-abm="visualize-2" data-id='${element.idPersona}' data-toggle="tooltip" title="Mas Detalles" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 31)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id='${element.id}' data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Agente" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 30)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id='${element.id}' data-abm="delete" data-target="#modalDelete" data-toggle="tooltip" title="Eliminar Agente" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>`;
        }
        (element.tareasActuales === '0' ? '' :
            btnList = `
            <button type="button" class="btn btn-outline-primary" data-id="${element.id}" data-abm="tareasActuales" data-target="#modalTareasActuales" data-toggle="tooltip" title="Ver Tareas Actuales" data-placement="top">
                <i class="fal fa-list fa-lg fa-fw"></i>
            </button>
        `);
        textoInner += `
        <tr>
            <td>
                <a href="#" data-abm="visualize-2" data-id='${element.idPersona}'>${element.id}</a>
            </td>
            <td>${element.nombre}</td>
            <td>${element.apellido}</td>
            <td>
                ${especializacionHTML}
            </td>
            <td>${element.tareasActuales}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnList}                                 
                    ${btnEye}
                    ${btnPencil}
                    ${btnTrash} 
                </div>
            </td>
        </tr>`;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4', [5], 'Agentes Registrados');
}

function modificarModal(datos) {
    $('#h3TitleModalUpdate').text("Modificar Agente '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#updateID').attr('value', datos['id']).val(datos['id']);
    $('#nombreyape').attr('value', datos['nombre'] + " " + datos['apellido']).val(datos['nombre'] + " " + datos['apellido']);
    var todasEspecializaciones = $('#idEspecializacionUpd').children();
    for (let index = 0; index < todasEspecializaciones.length; index++) {
        datos['listaEspecializaciones'].forEach(element => {
            if (element['id'] == ($(todasEspecializaciones[index]).val())) {
                $(todasEspecializaciones[index]).prop('selected', true);
            }
        });
    }
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Agente ${datos['nombre']} ${datos['apellido']}`);
}

function loadTareasActuales(datos) {
    $('#miTablaTareasActuales').DataTable().clear().destroy();
    let textoInner = ``;
    datos.listaTareasActuales.forEach(element => {
        let myDate = element['fechaInicio'].split(" ");
        myDate[0] = myDate[0].split("-").reverse().join("/");
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.idPedido}</td>
            <td>${myDate[0]} ${myDate[1]}</td>
            <td>${element.descripcion}</td>
            <td>
                <a href="#" data-abm="visualize-3" data-id-pedido=${element.idPedido} data-id-tarea=${element.id}>Pedido Nº ${element.idPedido} - Tarea Nº ${element.id}</a>
            </td>
        </tr>
            `
    });
    $('#miTablaTareasActuales tbody').html(textoInner);
    $('[data-abm=visualize-3]').on('click', function () {
        visualizarPedidoTareaRelacionada($(this).data('id-pedido'), $(this).data('id-tarea'));
    })
    $('#h3TitleTareasActuales').text(`Tareas Actuales de ${datos.nombre} ${datos.apellido}`);
    loadScriptOrdenarPagTablas('miTablaTareasActuales', '0,1,2,3,4', [], `Tareas Actuales ${datos.nombre} ${datos.descripcion}`);
}

async function visualizarPedidoTareaRelacionada(idPedido, idTarea) {
    let datos = await getFichaOne({
        "id": idTarea,
        "idPedido": idPedido
    }, "/tarea/");
    alertify.alert(
        "Detalles Tarea",
        `<strong>ID Pedido:</strong> ${datos.idPedido}
        <br><strong>ID Tarea:</strong> ${datos.id}
        <br><strong>Fecha Inicio:</strong> ${datos.fechaInicio}
        <br><strong>Fecha Fin:</strong> ${datos.fechaFin}
        <br><strong>Descripcion:</strong> ${datos.descripcion}
        <br><strong>Especializacion:</strong> ${datos.especializacionNombre}
        <br><strong>Estado:</strong> ${datos.estadoNombre}
        <br><strong>Prioridad:</strong> ${datos.prioridadNombre}
        `
    );
}