export {
    setUrl,
    setUrlAjax,
    setUrlAjax2,
    setUrlAjaxRxP,
    visualizarPersonaAgente,
    getPermisosRolActual,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag,
    getFichaOne,
    getFichaAll,
    modalGenDelete
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

//--FUNCIONES GENERALES--\\
//--Roles y Permisos--\\

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

function loadScriptValidarCampos(callBackAfterReloadTable, callBackAfterReloadTable2) {
    import('/public/js/generales/validarCampos.js').then((Module) => {
        Module.default(getFichaAll, callBackAfterReloadTable, callBackAfterReloadTable2);
    });
}

function loadScriptOrdenarPagTablas(tablaID, columnas, columNoOrdenar, titulo, bButtons, printDLName) {
    import('/public/js/generales/ordypagtablas.js').then((Module) => {
        Module.default(tablaID, columnas, columNoOrdenar, titulo, bButtons, printDLName);
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

function getFichaOne(id, urlConsulta) {
    let formdata = new FormData();
    formdata.append("id", id);
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