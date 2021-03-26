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

setUrl("/administracion/sectores/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);

//--SECTOR--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        (element.usado ? disabled = `disabled` : ``);
        if (permisosRolActual.some(item => item == 27)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Editar Sector" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 26)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id='${element.id}' data-abm="delete" data-target="#modalDelete" data-toggle="tooltip" title="Eliminar Sector" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
        }
        textoInner += `
            <tr>
                <td>${element.id}</td>
                <td>${element.nombre}</td>
                <td>${element.tipoSectorNombre}</td>
                <td>${element.responsable}</td>
                <td>${element.telefono}</td>
                <td>${element.email}</td>
                <td>
                    <div class="btn-group btn-group-sm float-none" role="group">
                        ${btnPencil}
                        ${btnTrash}
                    </div>
                </td>
            </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5', [6], 'Sectores Registrados');
}

function modificarModal(datos) {
    $('#h3TitleModalUpdate').text("Modificar Sector '" + datos['nombre'] + "'");
    $('#updateID').attr("value", datos['id']).val(datos['id']);
    $('#nombreUpdate').attr("value", datos['nombre']).val(datos['nombre']);
    $('#responsableUpdate').attr("value", datos['responsable']).val(datos['responsable']);
    $('#telefonoUpdate').attr("value", datos['telefono']).val(datos['telefono']);
    $('#emailUpdate').attr("value", datos['email']).val(datos['email']);
    $("#idTipoSectorUpd option[value='" + datos['idTipoSector'] + "']").prop('selected', true);
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Sector ${datos['nombre']}`);
}