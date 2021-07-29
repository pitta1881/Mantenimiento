export {
    setUrl,
    visualizarUpdateModalRxP,
    visualizarPersonaAgente,
    getPermisosRolActual,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag,
    getFichaOne,
    getFichaAll,
    modalGenDelete,
    getAgentesInsumos,
    reloadListenerActionButtonsTableGeneral,
    getTareasSinOT
}

let url;

function setUrl(newUrl) {
    url = newUrl;
}

//--FUNCIONES GENERALES--\\
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
                alertify.myAlert().close();
            });;
    });
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

const loadEventGenerico = async (e) => {
    let urlToUse = url;
    let btn = (e.target.closest('[data-abm]'));
    if (btn && !btn.disabled) {
        let ficha = await getFichaOne({
            'id': btn.dataset.id
        }, callbacks[btn.dataset.abm].url || urlToUse);
        if (ficha) {
            $(btn.dataset.target + " form").bootstrapValidator('resetForm', true);
            $(':input').each(function () {
                $(this).removeClass('is-valid is-invalid');
            });
            switch (btn.dataset.abm) {
                case "delete":
                    callbacks['delete'](ficha);
                    if (urlToUse != '/pedidos/') {
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
                    }
                    break;
                case "updateRolesPermisos":
                    callbacks['updateRolesPermisos'](ficha, true);
                    break;
                default:
                    (callbacks[btn.dataset.abm].callback ? callbacks[btn.dataset.abm].callback(ficha) : callbacks[btn.dataset.abm](ficha));
                    break;
            }
            $(btn.dataset.target).modal('show');
        } else {
            alertify.alert("<span class='fal fa-times-circle  fa-lg' style='vertical-align:middle;color:#e10000'></span><span style='font-size:15px; color:black'> Error</span>", "No se puede encontrar el item seleccionado");
        }
    }
}

function loadListenerActionButtons(callbacks) {
    window.callbacks = callbacks;
    document.getElementById('miTabla').addEventListener('click', loadEventGenerico);
    $('button[data-target="#modalNew"], button[data-target="#modalNewTarea"]').on('click', function () {
        $('#modalNew form').bootstrapValidator('resetForm', true);
        $('#modalNewTarea form').bootstrapValidator('resetForm', true);
        $(':input').each(function () {
            $(this).removeClass('is-valid is-invalid');
        });
    })
}

function reloadListenerActionButtonsTableGeneral() {
    document.getElementById('miTablaTarea').removeEventListener('click', loadEventGenerico);
    document.getElementById('miTablaTarea').addEventListener('click', loadEventGenerico)
}

function loadScriptValidarCampos(callBackAfterReloadTable) {
    import('/public/js/generales/validarCampos.js').then((Module) => {
        Module.default(getFichaAll, callBackAfterReloadTable);
    });
}

function loadScriptOrdenarPagTablas(tablaID, columnas, columNoOrdenar, titulo, bButtons, printDLName) {
    import('/public/js/generales/ordypagtablas.js').then((Module) => {
        Module.default(tablaID, columnas, columNoOrdenar, titulo, bButtons, printDLName);
    });
}


function loadTooltips() {
    $('table').on('mouseenter', 'a, button', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
}

function modalDrag() {
    $(".modal").draggable({
        handle: ".modal-header"
    });
}

function getFichaOne(whereJson, urlConsulta) {
    let formdata = new FormData();
    for (let index = 0; index < Object.keys(whereJson).length; index++) {
        formdata.append(Object.keys(whereJson)[index], Object.values(whereJson)[index]);
    }
    let requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };
    let miJson = fetch((urlConsulta || url) + "fichaOne", requestOptions)
        .then(handleJsonResponse)
        .then(datos => {
            return datos
        })
        .catch(error => {
            return false
        });
    return miJson;
}

function getFichaAll(urlParam) {
    let requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };
    let miJson = fetch((urlParam || url) + "fichaAll", requestOptions)
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

function getAgentesInsumos() {
    let requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };
    let miJson = fetch("/tarea/getAgentesInsumos/", requestOptions)
        .then(handleJsonResponse)
        .then(datos => {
            return datos
        })
        .catch(error => {
            return false
        });
    return miJson;
}

function getTareasSinOT() {
    let requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };
    let miJson = fetch("/tarea/getTareasSinOT/", requestOptions)
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