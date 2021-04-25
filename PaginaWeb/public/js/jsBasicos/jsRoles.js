import {
    setUrl,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    visualizarUpdateModalRxP,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
    modalGenDelete
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/roles/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'delete': deleteModal,
    'visualizarRolesPermisos': visualizarUpdateModalRxP,
    'updateRolesPermisos': visualizarUpdateModalRxP,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);

//--ROL--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        if (element.id != 0) {
            let disabled = ``;
            let btnEye = ``;
            let btnPencil = ``;
            let btnTrash = ``;
            (element.usado ? disabled = `disabled` : ``);
            if (permisosRolActual.some(item => item == 12)) {
                btnEye = ` 
                <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="visualizarRolesPermisos" data-toggle="tooltip" title="Ver Permisos" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
            }
            if (permisosRolActual.some(item => item == 11)) {
                btnPencil = `
                <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="updateRolesPermisos" data-toggle="tooltip" title="Editar Permisos" data-placement="top">
                    <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
                </button>
            `;
            }
            if (permisosRolActual.some(item => item == 10)) {
                btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id='${element.id}' data-abm="delete" data-target="#modalDelete" data-toggle="tooltip" title="Eliminar Rol" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
            }
            textoInner += `
            <tr>
                <td>${element.id}</td>
                <td>${element.nombre}</td>
                <td>
                    <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                    ${btnPencil}
                    ${btnTrash}
                    </div>
                </td>
            </tr>
        `;
        }
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Roles Registrados');
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Rol ${datos['nombre']}`);
}