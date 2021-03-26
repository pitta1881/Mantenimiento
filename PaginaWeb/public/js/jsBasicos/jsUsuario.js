import {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    visualizarPersonaAgente,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
    modalGenDelete
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/usuarios/");
setUrlAjax("/administracion/personas/");
setUrlAjaxRxP("/administracion/roles/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize-2': visualizarPersonaAgente,
    'updateRoles': modificarModalRoles,
    'visualizarRolesPermisos': visualizarUpdateModalRxP,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);

//--USUARIO--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let rolesHTML = ``;
        let btnCog = ``;
        let btnKey = ``;
        let btnTrash = ``;
        (element.usado || element.id == 1 ? disabled = `disabled` : ``);
        element.listaRoles.forEach(rol => {
            rolesHTML += `<a href="#" data-id='${rol.id}' data-abm="visualizarRolesPermisos">${rol.nombre}</a><br>`
        });
        btnCog = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="updateRoles" data-toggle="tooltip" data-target="#modalRolesUpdate" title="Modificar Roles" data-placement="top">
                <i class="fal fa-user-cog fa-lg fa-fw"></i>
            </button>`;
        if (permisosRolActual.some(item => item == 3)) {
            btnKey = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Contraseña" data-placement="top">
                <i class="fal fa-key fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 2)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id='${element.id}' data-abm="delete" data-target="#modalDelete" data-toggle="tooltip" title="Eliminar Usuario" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
        }
        textoInner += `
        <tr>
            <td>${element.nick}</td>
            <td>
                <a href="#" data-abm="visualize-2" data-id='${element.idPersona}'>${element.idPersona}</a>
            </td>
            <td>${element.nombreApe}</td>
            <td>
                ${rolesHTML}
            </td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnCog}
                    ${btnKey}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3', [4], 'Usuarios Registrados');
}

function modificarModal(datos) {
    $('#h3TitleModalUpdate').text("Modificar Contraseña de '" + datos['nick'] + "'");
    $('#updateID').attr('value', datos['id']);
}

function modificarModalRoles(datos) {
    $('#h3TitleModalRolesUpdate').text("Modificar Roles de '" + datos['nick'] + "'");
    $('#updateRolIdUsuario').attr('value', datos['id']);
    var todosRoles = $('#idRolUpd').children();
    for (let index = 0; index < todosRoles.length; index++) {
        datos['listaRoles'].forEach(element => {
            if (element['id'] == ($(todosRoles[index]).val())) {
                $(todosRoles[index]).attr('selected', 'selected');
            }
        });
    }
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Usuario ${datos['nick']}`);
}