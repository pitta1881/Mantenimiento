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

setUrl("/administracion/permisos/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);

//--PERMISO--\\
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
        if (permisosRolActual.some(item => item == 7)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Permiso" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 6)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="delete" data-toggle="tooltip" data-target="#modalDelete" title="Eliminar Permiso" data-placement="top">
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
                    ${btnPencil}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Permisos Registrados');
}

function modificarModal(datos) {
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Permiso ${datos['nombre']}`);
}