export {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
    visualizarSectorPedido,
    visualizarPedidoGeneral,
    modificarModalPedido,
    deleteModalPedido,
    modificarModalUsuario,
    modificarRolesModalUsuario,
    eliminarModalUsuario,
    modificarModalPersona,
    modificarEstadoModalPersona,
    eliminarModalPersona,
    eliminarModalRol,
    modificarModalPermiso,
    eliminarModalPermiso,
    modificarModalAgente,
    eliminarModalAgente,
    visualizarPersonaAgente,
    modificarModalSector,
    eliminarModalSector,
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
let urlAjaxRxP;

function setUrl(newUrl) {
    url = newUrl;
}

function setUrlAjax(newUrlAjax) {
    urlAjax = newUrlAjax;
}

function setUrlAjaxRxP(newUrlAjaxRxP) {
    urlAjaxRxP = newUrlAjaxRxP;
}

//--PEDIDOS--\\

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
        var myDate = element['fecha'].split(" ");
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

    loadScriptOrdenarPagTablas('miTablaTarea', '0,1,2,3,4,5,6,7', [], 'Tareas Registradas', true);
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
        `<form action='/administracion/roles/updateRol' method='post'>
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
}

//--USUARIO--\\
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
    $("#estadoUpdate option[value=" + datos['idEstadoPersona'] + "]").remove();
}

function eliminarModalPersona(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Persona ${datos['nombre']} ${datos['apellido']}`);
}

//--ROL--\\
function eliminarModalRol(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Rol ${datos['nombre']}`);
}


//--PERMISO--\\
function modificarModalPermiso(datos) {
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
}

function eliminarModalPermiso(datos) {
    document.getElementById('containerModalDelete').innerHTML = modalGenDelete(datos['id'], `Eliminar Permiso ${datos['nombre']}`);
}

//--AGENTE--\\
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
    document.querySelector('#miTabla').addEventListener('click', async function (e) {
        let urlToUse = url;
        let btn = (e.target.closest('button[type="button"], a'));
        if (btn && !btn.disabled) {
            if (btn.dataset.abm == "visualize-2") {
                urlToUse = urlAjax;
            } else if (btn.dataset.abm == "visualizarRolesPermisos") {
                urlToUse = urlAjaxRxP;
            }
            let ficha = await getFichaOne(btn.dataset.id, urlToUse);
            if (ficha) {
                switch (btn.dataset.abm) {
                    case "update":
                        $("#modalUpdate form").bootstrapValidator('resetForm', true);
                        $(':input').each(function () {
                            $(this).removeClass('is-valid is-invalid');
                        });
                        callbacks['update'](ficha);
                        break;
                    case "delete":
                        callbacks['delete'](ficha);
                        break;
                    case "visualize":
                        callbacks['visualize'](ficha);
                        break;
                    case "visualize-2":
                        callbacks['visualize-2'](ficha);
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
}

function loadScriptValidarCampos() {
    import('/public/js/generales/validarCampos.js').then((Module) => {
        Module.default(getFichaAll);
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