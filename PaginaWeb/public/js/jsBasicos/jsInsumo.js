import {
    setUrl,
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

setUrl("/insumos/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'historial': loadHistorial,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);

//--INSUMOS--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let btnHistorial = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        (element.usado ? disabled = `disabled` : ``);
        btnHistorial = `
            <button type="button" class="btn btn-outline-primary" data-id="${element.id}" data-abm="historial" data-target="#modalHistorial" data-toggle="tooltip" title="Ver Historial" data-placement="top">
                <i class="fal fa-history fa-lg fa-fw"></i>
            </button>
        `;
        if (permisosRolActual.some(item => item == 43)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Insumo" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 42)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="delete" data-toggle="tooltip" data-target="#modalDelete" title="Eliminar Insumo" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
        }
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.stockReal}</td>
            <td>${element.stockComprometido}</td>
            <td>${element.stockFuturo}</td>
            <td>${element.medidaNombre}</td>
            <td>${element.stockMinimo}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnHistorial}
                    ${btnPencil}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7', [8], 'Insumos Registrados');
}

function modificarModal(datos) {
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']).val(datos['id']);
    $('#nombreUpd').attr('value', datos['nombre']).val(datos['nombre']);
    $('#idMedidaUpd option[value=' + datos.idMedida + ']').prop('selected', true);
    $('#stockMinimoUpd').attr('value', datos['stockMinimo']).val(datos['stockMinimo']);
    $('#descripcionUpd').attr('value', datos['descripcion']).val(datos['descripcion']);
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Insumo ${datos['nombre']} ${datos['descripcion']}`);
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
            <td>${(element.inOrOut == 0 ? `Salida` : `Entrada`)}</td>
            <td>${element.newStock - element.oldStock}</td>
            <td>${element.oldStock}</td>
            <td>${element.newStock}</td>
            <td>${(element.idOC != null ? `
            <a href="#" data-abm="visualize-2" data-id='${element.idOC}'>Orden de Compra Nº ${element.idOC}</a>
            `:`
            <a href="#" data-abm="visualize-3" data-id-pedido=${element.idPedido} data-id-tarea=${element.idTarea}>Pedido Nº ${element.idPedido} - Tarea Nº ${element.idTarea}</a>
            `)}</td>
        </tr>
            `
    });
    $('#miTablaHistorial tbody').html(textoInner);
    $('[data-abm=visualize-2]').on('click', function () {
        visualizarOrdenDeCompraRelacionada($(this).data('id'));
    })
    $('[data-abm=visualize-3]').on('click', function () {
        visualizarPedidoTareaRelacionada($(this).data('id-pedido'), $(this).data('id-tarea'));
    })
    $('#h3TitleModalHistorial').text(`Historial Insumo ${datos.nombre} ${datos.descripcion}`);
    loadScriptOrdenarPagTablas('miTablaHistorial', '0,1,2,3,4,5,6,7', [], `Historial Insumo ${datos.nombre} ${datos.descripcion}`);
}

async function visualizarOrdenDeCompraRelacionada(idOC) {
    let datos = await getFichaOne({
        "id": idOC
    }, "/ordendecompra/");
    alertify.alert(
        "Detalles Orden de Compra",
        `<strong>ID:</strong> ${datos.id}
        <br><strong>Fecha:</strong> ${datos.fecha}
        <br><strong>Costo Estimado:</strong> $${datos.costoEstimado}
        <br><strong>Costo Total:</strong> ${(datos.costoFinal == '-' ? '-' : `$${datos.costoFinal}`)}
        <br><strong>Estado:</strong> ${datos.estadoNombre}
        <br><strong>Tipo:</strong> ${datos.tipoNombre}
        <br><strong>Cantidad Insumos:</strong> ${datos.cantidadInsumos}
        `
    );
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