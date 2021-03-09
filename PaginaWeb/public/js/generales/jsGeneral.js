export {
    setUrl,
    setUrlAjax,
    setUrlAjax2,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    loadTablePedido,
    visualizarSectorPedido,
    visualizarPedidoGeneral,
    modificarModalPedido,
    deleteModalPedido,
    loadTableUsuario,
    modificarModalUsuario,
    modificarRolesModalUsuario,
    eliminarModalUsuario,
    loadTablePersona,
    modificarModalPersona,
    modificarEstadoModalPersona,
    eliminarModalPersona,
    loadTableRol,
    eliminarModalRol,
    loadTablePermiso,
    modificarModalPermiso,
    eliminarModalPermiso,
    loadTableAgente,
    modificarModalAgente,
    eliminarModalAgente,
    visualizarPersonaAgente,
    loadTableSector,
    modificarModalSector,
    eliminarModalSector,
    loadTableEspecializacion,
    modificarModalEspecializacion,
    eliminarModalEspecializacion,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag,
    logOut
}

let url;
let urlAjax;
let urlAjax2;
let urlAjaxRxP;

function setUrl(newUrl) {
    url = newUrl;
}

function setUrlAjax(newUrlAjax) {
    urlAjax = newUrlAjax;
}

function setUrlAjax2(newUrlAjax2) {
    urlAjax2 = newUrlAjax2;
}

function setUrlAjaxRxP(newUrlAjaxRxP) {
    urlAjaxRxP = newUrlAjaxRxP;
}

//--PEDIDOS--\\
async function loadTablePedido() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    if (fichaAll.length > 0) {
        fichaAll.forEach(element => {
            let disabled = ``;
            let btnEye = ``;
            let btnPencil = ``;
            let btnTrash = ``;
            (element.usado || element.id == 1 ? disabled = `disabled` : ``);
            if (permisosRolActual.some(item => item == 16)) {
                btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="visualize" data-target="#modalGeneral" title="Ver Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
            }
            if (element.idEstado != 4 && element.idEstado != 5 && permisosRolActual.some(item => item == 15)) {
                btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="update" data-target="#modalUpdate" title="Editar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
            }
            if (element.idEstado == 1 && element.tareasAsignadas == 0 && permisosRolActual.some(item => item == 14)) {
                btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" data-id='${element.id}' data-abm="delete" data-target="#modalDelete" title="Cancelar Pedido" data-toggle="tooltip" data-placement="top">
                <i class="fal fa-trash-alt fa-lg fa-fw"></i>
            </button>
            `;
            }
            textoInner += `
        <tr>
            <th scope="row">${element.id}</th>
            <td>${element.descripcion}</td>
            <td>
                <a href="#" data-abm="visualize-2" data-id='${element.idSector}'>${element.sectorNombre}</a>
            </td>
            <td>${element.fechaInicio}</td>
            <td>${element.fechaFin}</td>
            <td>${element.tareasAsignadas}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.prioridadNombre}</td>
            <td>${element.usuarioNick}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                    ${btnPencil}
                    ${btnTrash}
                </div>
            </td>
        </tr>
        `;
        });
    }
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7,8', [9], 'Pedidos Registrados', false);
}

function visualizarPedidoGeneral(datos) {
    loadDlPedido(datos);
    loadHistorial(datos);
    loadTareas(datos);
}

function loadDlPedido(datos) {
    let textoInner = ``;
    var myDate = datos['fechaInicio'].split(" ");
    myDate[0] = myDate[0].split("-").reverse().join("/");
    textoInner += `
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Nº Pedido</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.id}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Descripcion</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.descripcion}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Sector</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.sectorNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Inicio</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaInicio}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Fecha Fin</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaFin}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Tareas</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.tareasAsignadas}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Estado</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.estadoNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Prioridad</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.prioridadNombre}</dd>
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Usuario</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.usuarioNick}</dd>
            `;
    document.getElementById('dlPedido').innerHTML = textoInner;
}

function loadHistorial(datos) {
    let textoInner = ``;
    datos.historial.forEach(element => {
        let myDate = element['fecha'].split(" ");
        myDate[0] = myDate[0].split("-").reverse().join("/");
        textoInner += `
        <tr>
            <th scope="row">${element.id}</th>
            <td>${myDate[0]} ${myDate[1]}</td>
            <td>${element.nickUsuario}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.observacion}</td>
        </tr>
            `
    });
    loadScriptOrdenarPagTablas('miTablaHistorial', '0,1,2,3', [], 'Historial', true, textoInner);
}

function loadTareas(datos) {
    let textoInner = ``;
    if (datos.idEstado == 4 || datos.idEstado == 6) {
        $('button[data-target="#modalNewTarea"]').hide();
    } else {
        $('button[data-target="#modalNewTarea"]').show();
    }
    datos.tareas.forEach(tarea => {
        let myDateInicio = tarea['fechaInicio'].split(" ");
        myDateInicio[0] = myDateInicio[0].split("-").reverse().join("/");
        let myDateFin = ['-', ''];
        if (tarea['fechaFin'] != '-') {
            myDateFin = tarea['fechaFin'].split(" ");
            myDateFin[0] = myDateFin[0].split("-").reverse().join("/");
        }
        let agentesHTML = '';
        tarea.agentes.forEach(agente => {
            agentesHTML += `<a href="#" data-abm="visualize-3" data-id=${agente.id}>${agente.nombre} ${agente.apellido}</a><br>`
        })
        textoInner += `
        <tr>
            <th scope="row">${tarea.id}</th>
            <td>${myDateInicio[0]} ${myDateInicio[1]}</td>
            <td>${myDateFin[0]} ${myDateFin[1]}</td>
            <td>${tarea.descripcion}</td>
            <td>${tarea.especializacionNombre}</td>
            <td>${tarea.prioridadNombre}</td>
            <td>${tarea.estadoNombre}</td>
            <td>${tarea.nickUsuario}</td>
            <td>${agentesHTML}</td>
            
        </tr>
        `
    });
    $('#idPedidoTarea').attr('value', datos.id).val(datos.id);
    $('#idPrioridadTarea option[value=' + datos.idPrioridad + ']').prop('selected', true);
    loadScriptOrdenarPagTablas('miTablaTarea', '0,1,2,3,4,5,6,7,8', [], 'Tareas Registradas', true, textoInner);
}

function visualizarSectorPedido(datos) {
    alertify.alert("Detalles Sector",
        `
        <strong>Nombre:</strong> ${datos.nombre}
        <br> <strong>Responsable:</strong> ${datos.responsable}
        <br> <strong>Tipo:</strong> ${datos.tipoSectorNombre}
        <br> <strong>Email:</strong> ${datos.email}
        <br> <strong>Telefono:</strong> ${datos.telefono}
        `
    );

}

function modificarModalPedido(datos) {
    var myDate = datos['fechaInicio'].split(" ");
    myDate = myDate[0].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Pedido " + datos['id']);
    $('#updateID').attr('value', datos['id']);
    $('#idUsuarioUpdate').attr('value', datos['idUsuario']).val(datos['usuarioNick']);
    $('#fechaInicioUpdate').attr('value', myDate).val(myDate);
    $('#idEstadoUpdateHid').attr('value', datos['idEstado']).val(datos['idEstado']);
    $('#idEstadoUpdate').attr('value', datos['estadoNombre']).val(datos['estadoNombre']);
    $("#idSectorUpdate option[value=" + datos['idSector'] + "]").prop('selected', true)
    $("#idPrioridadUpdate option[value=" + datos['idPrioridad'] + "]").prop('selected', true)
    $('#descripcionUpdate').val(datos['descripcion']);
}

function deleteModalPedido(datos) {
    $('#h3TitleModalDelete').text("Cancelar Pedido " + datos['id']);
    $('#deleteID').attr('value', datos['id']);
}


//--Roles y Permisos--\\
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
                loadTableRol();
                alertify.myAlert().close();
            });;
    });
}

//--USUARIO--\\
async function loadTableUsuario() {
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

function modificarModalUsuario(datos) {
    $('#h3TitleModalUpdate').text("Modificar Contraseña de '" + datos['nick'] + "'");
    $('#updateID').attr('value', datos['id']);
}

function modificarRolesModalUsuario(datos) {
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

function eliminarModalUsuario(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Usuario ${datos['nick']}`);
}


//--PERSONA--\\
async function loadTablePersona() {
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

function modificarModalPersona(datos) {
    var myDate = datos['fechaNacimiento'].split("/").reverse().join("-");
    $('#h3TitleModalUpdate').text("Modificar Persona '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#updateID').attr('value', datos['id']).val(datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']).val(datos['nombre']);
    $('#apellidoAnteriorUpdate').attr('value', datos['apellido']).val(datos['apellido']);
    $('#direccionAnteriorUpdate').attr('value', datos['direccion']).val(datos['direccion']);
    $('#emailAnteriorUpdate').attr('value', datos['email']).val(datos['email']);
    $('#fechaAnteriorUpdate').attr('value', myDate).val(myDate);
}

function modificarEstadoModalPersona(datos) {
    $('#updateEstadoID').attr('value', datos['id']);
    $('#estadoUpdate option[value=' + datos.idEstadoPersona + ']').prop('selected', true);
}

function eliminarModalPersona(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Persona ${datos['nombre']} ${datos['apellido']}`);
}

//--ROL--\\
async function loadTableRol() {
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

function eliminarModalRol(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Rol ${datos['nombre']}`);
}


//--PERMISO--\\
async function loadTablePermiso() {
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

function modificarModalPermiso(datos) {
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
}

function eliminarModalPermiso(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Permiso ${datos['nombre']}`);
}

//--AGENTE--\\
async function loadTableAgente() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let especializacionHTML = ``;
        let btnEye = ``;
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
            <td>${element.isDisponible}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
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

function modificarModalAgente(datos) {
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

function eliminarModalAgente(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Agente ${datos['nombre']} ${datos['apellido']}`);
}

function visualizarPersonaAgente(datos) {
    alertify.alert(
        "Detalles Persona",
        `<strong>DNI:</strong> ${datos.id}
        <br> <strong>Nombre y Apellido:</strong> ${datos.nombre} ${datos.apellido}
        <br> <strong>Fecha de Nacimiento:</strong> ${datos.fechaNacimiento}
        <br> <strong>Direccion:</strong> ${datos.direccion} 
        <br> <strong>Email:</strong> ${datos.email}
        `
    );
}

//--SECTOR--\\
async function loadTableSector() {
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

function modificarModalSector(datos) {
    $('#h3TitleModalUpdate').text("Modificar Sector '" + datos['nombre'] + "'");
    $('#updateID').attr("value", datos['id']).val(datos['id']);
    $('#nombreUpdate').attr("value", datos['nombre']).val(datos['nombre']);
    $('#responsableUpdate').attr("value", datos['responsable']).val(datos['responsable']);
    $('#telefonoUpdate').attr("value", datos['telefono']).val(datos['telefono']);
    $('#emailUpdate').attr("value", datos['email']).val(datos['email']);
    $("#idTipoSectorUpd option[value='" + datos['idTipoSector'] + "']").prop('selected', true);
}

function eliminarModalSector(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Sector ${datos['nombre']}`);
}

//--ESPECIALIZACION--\\
async function loadTableEspecializacion() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let btnPencil = ``;
        let btnTrash = ``;
        (element.usado ? disabled = `disabled` : ``);
        if (permisosRolActual.some(item => item == 35)) {
            btnPencil = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="update" data-target="#modalUpdate" data-toggle="tooltip" title="Modificar Especializacion" data-placement="top">
                <i class="fal fa-pencil-alt fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 34)) {
            btnTrash = ` 
            <button type="button" class="btn btn-outline-primary" ${disabled} data-id="${element.id}" data-abm="delete" data-toggle="tooltip" data-target="#modalDelete" title="Eliminar Especializacion" data-placement="top">
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
        </tr>`;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1', [2], 'Especializaciones Registradas');
}

function modificarModalEspecializacion(datos) {
    $('#h3TitleModalUpdate').text("Modificar Especializacion '" + datos['nombre'] + "'");
    $('#updateID').text(datos['id']).val(datos['id']);
    $('#nombreAnterior').text(datos['nombre']).val(datos['nombre']);
}

function eliminarModalEspecializacion(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Especializacion ${datos['nombre']}`);
}

//--FUNCIONES GENERALES--\\
function loadListenerActionButtons(callbacks) {
    $('#miTabla').on('click', async function (e) {
        let urlToUse = url;
        let btn = (e.target.closest('button[type="button"], a'));
        if (btn && !btn.disabled) {
            if (btn.dataset.abm == "visualize-2") {
                urlToUse = urlAjax;
            } else if (btn.dataset.abm == "visualize-3") {
                urlToUse = urlAjax2;
            } else if (btn.dataset.abm == "visualizarRolesPermisos") {
                urlToUse = urlAjaxRxP;
            }
            let ficha = await getFichaOne(btn.dataset.id, urlToUse);
            if (ficha) {
                $(btn.dataset.target + " form").bootstrapValidator('resetForm', true);
                $(':input').each(function () {
                    $(this).removeClass('is-valid is-invalid');
                });
                switch (btn.dataset.abm) {
                    case "update":
                        callbacks['update'](ficha);
                        break;
                    case "delete":
                        callbacks['delete'](ficha);
                        $('#modalDelete form').on('submit', function (e) {
                            e.preventDefault();
                            let that = this;
                            $.post($(this).attr('action'), $(this).serialize())
                                .done(function (data) {
                                    verificarAlertas(data);
                                    callbacks['loadTable']();
                                    $(that).closest('.modal').modal('hide');
                                });;
                        })
                        break;
                    case "visualize":
                        callbacks['visualize'](ficha);
                        break;
                    case "visualize-2":
                        callbacks['visualize-2'](ficha);
                        break;
                    case "visualize-3":
                        callbacks['visualize-3'](ficha);
                        break;
                    case "updateEstado":
                        callbacks['updateEstado'](ficha);
                        break;
                    case "updateRoles":
                        callbacks['updateRoles'](ficha);
                        break;
                    case "visualizarRolesPermisos":
                        callbacks['visualizarRolesPermisos'](ficha, false);
                        break;
                    case "updateRolesPermisos":
                        callbacks['updateRolesPermisos'](ficha, true);
                        break;
                    default:
                        break;
                }
                $(btn.dataset.target).modal('show');
            } else {
                alertify.alert("<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>", "No se puede encontrar el item seleccionado");
            }
        }
    })
    $('button[data-target="#modalNew"]').on('click', function () {
        $('#modalNew form').bootstrapValidator('resetForm', true);
        $(':input').each(function () {
            $(this).removeClass('is-valid is-invalid');
        });
    })
}

function loadScriptValidarCampos(callBackAfterReloadTable) {
    import('/public/js/generales/validarCampos.js').then((Module) => {
        Module.default(getFichaAll, callBackAfterReloadTable);
    });
}

function loadScriptOrdenarPagTablas(tablaID, columnas, columNoOrdenar, titulo, modal, textoHTML) {
    import('/public/js/generales/ordypagtablas.js').then((Module) => {
        Module.default(tablaID, columnas, columNoOrdenar, titulo, modal, textoHTML);
    });
}


function loadTooltips() {
    $("#miTabla").on('mouseenter', '[type="button"]', function () {
        var listaBotones = $('[data-toggle="tooltip"]').children();
        Object.keys(listaBotones).forEach(function (key) {
            if (!($(listaBotones[key]).prop('disabled'))) {
                $(listaBotones[key]).parent().tooltip();
            }
        });
    });
}

function modalDrag() {
    $(".modal").draggable({
        handle: ".modal-header"
    });
}

function logOut() {
    $("a[href$='logOut']").click(function () {
        sessionStorage.clear();
    });
}

//--FUNCIONES NO EXPORTABLES--\\
function getFichaOne(id, urlConsulta) {
    let formdata = new FormData();
    formdata.append("id", id);
    let requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };
    let miJson = fetch(urlConsulta + "fichaOne", requestOptions)
        .then(handleJsonResponse)
        .then(datos => {
            return datos
        })
        .catch(error => {
            return false
        });
    return miJson;
}

function getFichaAll() {
    let requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };
    let miJson = fetch(url + "fichaAll", requestOptions)
        .then(handleJsonResponse)
        .then(datos => {
            return datos
        })
        .catch(error => {
            return false
        });
    return miJson;
}

function getPermisosRolActual() {
    let requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };
    let miJson = fetch('/permisosRolActual', requestOptions)
        .then(handleJsonResponse)
        .then(datos => {
            return datos
        })
        .catch(error => {
            return false
        });
    return miJson;
}

function handleJsonResponse(response) {
    if (!response.ok) {
        throw new Error("Error ajax");
    }
    return response.json();
}

function modalGenDelete(idToDelete, titulo) {
    return `
    <div class="modal fade" id="modalDelete">
			<div class="modal-dialog">
				<div
					class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h3 class="modal-title m-0">${titulo}</h3>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<p class="mb-3">¿Está seguro?</p>
						<form action="delete" method="post">
							<input
							type="text" name="id" value="${idToDelete}" hidden>
							<!-- Modal Footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Salir</button>
								<button type="submit" class="btn btn-danger btn-modal">Eliminar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        `
}