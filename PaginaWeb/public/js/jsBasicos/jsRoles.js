import {
    setUrl,
    setUrlAjaxRxP,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
    modalGenDelete
} from '/public/js/generales/jsGeneral.js';

setUrl("/administracion/roles/");
setUrlAjaxRxP("/administracion/roles/");

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

function visualizarUpdateModalRxP(datos, modificar) {
    var modificable = '';
    var btnEnviar = '';
    var disableChk = '';
    var headerAlert = 'Detalle Rol';
    if (modificar) {
        btnEnviar = "<button type='submit' class='btn btn-success btn-modal float-left'>Enviar</button>";
        headerAlert = "Modificar permisos del Rol"
    } else {
        modificable = " onclick='javascript: return false;'";
        disableChk = 'disabled';
    }
    let permisosNombres = ['Usuarios', 'Permisos', 'Rol', 'Pedido', 'Tarea', 'OT', 'Sector', 'Agente', 'Especialidad', 'Evento', 'Insumo', 'Persona', 'OC'];
    let permisosArrayLength = 52;
    let td = function () {
        let indexNombres = 0;
        let retorno = `<tr>`;
        for (let index = 0; index < permisosArrayLength; index++) {
            let checkar = "";
            (datos.misPermisos.includes((index + 1).toString()) ? checkar = "checked" : "");
            if (index % 4 == 0) {
                retorno += `</tr><tr><td>${permisosNombres[indexNombres++]}</td>`
            }
            retorno += `<td><input type='checkbox' name='permisos[]' value='${index + 1}' ${disableChk} readonly='readonly' ${checkar} ${modificable} ></td>`
        }
        retorno += `</tr>`
        return retorno;
    }
    alertify.myAlert(headerAlert,
        `<form action='/administracion/roles/update' method='post' id="formRolUpd">
                <input type='text' name='id' value=${datos.id} + " hidden>
                <table id='miTabla' class='table table-bordered table-sm table-striped table-hover text-nowrap'>
                <thead class='headtable'>
                <tr>
                <th>Modulo</th>
                <th>A</th>
                <th>B</th>
                <th>M</th>
                <th>V</th>
                </tr>
                </thead>
                <tbody>                
                ${td()}                
                </tbody>
                </table>
                <div style='display:inline-block'>
                <small class='text-muted d-block'>A=ALTA</small>
                <small class='text-muted d-block'>B=BAJA</small>
                <small class='text-muted d-block'>M=MODIFICACION</small>
                <small class='text-muted d-block'>V=VISUALIZACION</small>
                </div>
                ${btnEnviar}
                </form>`);
    $('#formRolUpd').bootstrapValidator().on('success.form.bv', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize())
            .done(function (data) {
                verificarAlertas(data);
                loadTable();
                alertify.myAlert().close();
            });;
    });
}