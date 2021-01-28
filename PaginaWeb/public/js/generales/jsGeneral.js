export {
    setUrl,
    setUrlAjax,
    setUrlAjaxRxP,
    visualizarUpdateModalRxP,
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

function visualizarUpdateModalRxP(datos, modificar) {
    console.log(datos);
    var modificable = '';
    var btnEnviar = '';
    var disableChk = '';
    var headerAlert = 'Detalle Rol';
    if (modificar) {
        btnEnviar = "<button type='submit' class='btn btn-success btn-modal float-right'>Enviar</button>";
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
    $('#h3TitleModalDelete').text("Eliminar Usuario '" + datos['nick'] + "'");
    $('#deleteID').attr('value', datos['id']);
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
    $('#h3TitleModalDelete').text("Eliminar Persona '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#deleteID').attr('value', datos['id']);
}

//--ROL--\\
function eliminarModalRol(datos) {
    $('#h3TitleModalDelete').text("Eliminar Rol " + datos['nombre']);
    $('#deleteID').attr('value', datos['id']);
}


//--PERMISO--\\
function modificarModalPermiso(datos) {
    $('#h3TitleModalUpdate').text("Modificar Permiso");
    $('#updateID').attr('value', datos['id']);
    $('#nombreAnteriorUpdate').attr('value', datos['nombre']);
}

function eliminarModalPermiso(datos) {
    $('#h3TitleModalDelete').text("Eliminar Permiso " + datos['nombre']);
    $('#deleteID').attr('value', datos['id']);
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
    $('#h3TitleModalDelete').text("Eliminar Agente '" + datos['nombre'] + " " + datos['apellido'] + "'");
    $('#deleteID').attr('value', datos['id']);
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
    $('#h3TitleModalDelete').text("Eliminar Sector '" + datos['nombre'] + "'");
    $('#deleteID').attr("value", datos['id']).val(datos['id']);
}

//--ESPECIALIZACION--\\
function modificarModalEspecializacion(datos) {
    $('#h3TitleModalUpdate').text("Modificar Especializacion '" + datos['nombre'] + "'");
    $('#updateID').text(datos['id']).val(datos['id']);
    $('#nombreAnterior').text(datos['nombre']).val(datos['nombre']);
}

function eliminarModalEspecializacion(datos) {
    $('#h3TitleModalDelete').text("Eliminar Especializacion '" + datos['nombre'] + "'");
    $('#deleteID').text(datos['id']).val(datos['id']);
}

//--FUNCIONES GENERALES--\\
function loadListenerActionButtons(callbackUpdate, callbackDelete, callbackVisualizer, callBackUpdateEstado, callBackUpdateRoles, visualizarUpdateModalRxP) {
    document.querySelector('#miTabla').addEventListener('click', async function (e) {
        let urlToUse = url;
        let btn = (e.target.closest('button, a'));
        if (btn && !btn.disabled) {
            if (btn.dataset.abm == "visualizer") {
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
                        callbackUpdate(ficha);
                        break;
                    case "delete":
                        callbackDelete(ficha);
                        break;
                    case "visualizer":
                        callbackVisualizer(ficha);
                        break;
                    case "updateEstado":
                        callBackUpdateEstado(ficha);
                        break;
                    case "updateRoles":
                        callBackUpdateRoles(ficha);
                        break;
                    case "visualizarRolesPermisos":
                        visualizarUpdateModalRxP(ficha, false);
                        break;
                    case "updateRolesPermisos":
                        visualizarUpdateModalRxP(ficha, true);
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

function loadScriptOrdenarPagTablas(tablaID, columnas, columNoOrdenar, titulo) {
    import('/public/js/generales/ordypagtablas.js').then((Module) => {
        Module.default(tablaID, columnas, columNoOrdenar, titulo);
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