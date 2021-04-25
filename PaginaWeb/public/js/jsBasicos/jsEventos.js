import {
    setUrl,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
    modalGenDelete
} from '/public/js/generales/jsGeneral.js';

setUrl("/eventos/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'updateEstado': modificarEstadoModal,
    'delete': deleteModal,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);

//--EVENTOS--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let btnCrearPedido = ``;
        let btnSetFinalizado = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        (element.usado ? disabled = `disabled` : ``);
        if (permisosRolActual.some(item => item == 13)) {
            if (element.idEstado == 3) {
                btnCrearPedido = ` 
            <button type="submit" class="btn btn-outline-primary btn-submit-pedido" data-toggle="tooltip" title="Crear Pedido" data-placement="top">
                <form action="/pedidos/" method="post">
                    <input type="text" name="eventoID" value="${element.id}" hidden>
                    <input type="text" name="eventoNombre" value="${element.nombre}" hidden>
                    <input type="text" name="eventoDescripcion" value="${element.descripcion}" hidden>
                    <i class="fal fa-file-plus fa-lg fa-fw"></i>
                </form>
            </button>
            `;
                btnSetFinalizado = ` 
            <button type="button" class="btn btn-outline-primary" data-id="${element.id}" data-abm="updateEstado" data-target="#modalUpdateEstado" data-toggle="tooltip" title="Marcar como Hecho" data-placement="top">
                <i class="fal fa-check-circle fa-lg fa-fw"></i>
            </button>
            `;
            }
        }
        if (permisosRolActual.some(item => item == 39)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Evento" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 38)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="delete" data-toggle="tooltip" data-target="#modalDelete" title="Eliminar Evento" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
        }
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.fechaInicio.split(" ")[0]}</td>
            <td>${element.fechaFin.split(" ")[0]}</td>
            <td>${element.periodicidad} días</td>
            <td>${(element.idEstado == 6 ? 'Pedido Creado' : element.estadoNombre)}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnSetFinalizado}    
                    ${btnCrearPedido}
                    ${btnPencil}
                    ${btnTrash}
                </div>
            </td>
        </tr>`;
    });
    $('#miTabla tbody').html(textoInner);
    $('.btn-submit-pedido').on('click', function () {
        $(this).children('form').submit();
    })
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5', [6], 'Eventos Registrados');
}

function modificarModal(datos) {
    datos['fechaInicio'] = datos['fechaInicio'].split(" ")[0].split("/").reverse().join("-");
    datos['fechaFin'] = datos['fechaFin'].split(" ")[0].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Evento '" + datos['nombre'] + "'");
    $('#updateID').text(datos['id']).val(datos['id']);
    $('#nombreUpd').text(datos['nombre']).val(datos['nombre']);
    $('#descripcionUpd').text(datos['descripcion']).val(datos['descripcion']);
    $('#fechaInicioUpd').val(datos['fechaInicio']).attr('min', datos['fechaInicio']);
    $('#fechaFinUpd').val(datos['fechaFin']);
    $('#periodicidadUpd').text(datos['periodicidad']).val(datos['periodicidad']);
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Evento ${datos['nombre']}`);
}

function modificarEstadoModal(datos) {
    $('#updateEstadoID').text(datos['id']).val(datos['id']);
}