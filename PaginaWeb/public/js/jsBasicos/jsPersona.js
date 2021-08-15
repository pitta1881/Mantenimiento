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
handleBtnNewPersona();
handleProvCiud();

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
            <td>${element.direccion.provinciaNombre}-${element.direccion.ciudadNombre} ${element.direccion.calle} ${element.direccion.numero}</td>
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
    await loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6', [7], 'Personas Registradas');
    $('#miTabla_2').parents('th').click();
}

function modificarModal(datos) {
    var myDate = datos['fechaNacimiento'].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Persona '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#updateID').attr('value', datos['id']).val(datos['id']);
    $('#idDireccionUpd').attr('value', datos['idDireccion']).val(datos['idDireccion']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']).val(datos['nombre']);
    $('#apellidoAnteriorUpdate').attr('value', datos['apellido']).val(datos['apellido']);
    $(`#provinciaAnteriorUpd option[value=${datos['direccion'].idProvincia}]`).prop('selected', true);
    $('#provinciaAnteriorUpd').change()
    $(`#ciudadAnteriorUpd option[value=${datos['direccion'].idCiudad}]`).prop('selected', true);
    $('#calleAnteriorUpd').attr('value', datos['direccion'].calle).val(datos['direccion'].calle);
    $('#numeroAnteriorUpd').attr('value', datos['direccion'].numero).val(datos['direccion'].numero);
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

function handleBtnNewPersona() {
    $('#btn-newPersona').on('click', function () {
        $('select[name=idCiudad] option').attr('hidden', true);
        $('select[name=idCiudad] option:disabled').attr('hidden', false).prop('selected', true);
    })
}

function handleProvCiud() {
    $('#provincia, #provinciaAnteriorUpd').on('change', function () {
        $(this).parents('form').find('select[name=idCiudad] option').attr('hidden', true).prop('selected', false);
        $(this).parents('form').find('select[name=idCiudad] option:disabled').attr('hidden', false).prop('selected', true);
        $(this).parents('form').find(`select[name=idCiudad] option[data-provincia=${$(this).val()}]`).attr('hidden', false);
    })
}