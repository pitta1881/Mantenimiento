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

setUrl("/administracion/personas/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'updateEstado': modificarEstadoModal,
    'loadTable': loadTable,
});
loadScriptValidarCampos(loadTable);

//--PERSONA--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        if (element.id != 0) {
            let disabled = ``;
            let btnPencil = ``;
            let btnClock = ``;
            let btnTrash = ``;
            (element.usado ? disabled = `disabled` : ``);
            if (permisosRolActual.some(item => item == 47)) {
                btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" data-id="${element.id}" data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Persona" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
                btnClock = `
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="updateEstado" data-target="#modalEstadoUpdate" data-toggle="tooltip" title="Modificar Estado" data-placement="top">
                <i class="fal fa-user-clock fa-lg fa-fw"></i>
            </button>
            `;
            }
            if (permisosRolActual.some(item => item == 46)) {
                btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="delete" data-toggle="tooltip" data-target="#modalDelete" title="Eliminar Persona" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
            }
            textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.nombre}</td>
            <td>${element.apellido}</td>
            <td>${element.direccion}</td>
            <td>${element.email}</td>
            <td>${element.fechaNacimiento}</td>
            <td>${element.estadoNombre}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnPencil}
                    ${btnClock}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
        }
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6', [7], 'Personas Registradas');
}

function modificarModal(datos) {
    var myDate = datos['fechaNacimiento'].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Persona '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#updateID').attr('value', datos['id']).val(datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']).val(datos['nombre']);
    $('#apellidoAnteriorUpdate').attr('value', datos['apellido']).val(datos['apellido']);
    $('#direccionAnteriorUpdate').attr('value', datos['direccion']).val(datos['direccion']);
    $('#emailAnteriorUpdate').attr('value', datos['email']).val(datos['email']);
    $('#fechaAnteriorUpdate').attr('value', myDate).val(myDate);
}

function modificarEstadoModal(datos) {
    $('#updateEstadoID').attr('value', datos['id']);
    $('#estadoUpdate option[value=' + datos.idEstadoPersona + ']').prop('selected', true);
}

function deleteModal(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Persona ${datos['nombre']} ${datos['apellido']}`);
}