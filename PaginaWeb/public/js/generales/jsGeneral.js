export {
    setUrl,
    setUrlAjax,
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

function setUrl(newUrl) {
    url = newUrl;
}

function setUrlAjax(newUrlAjax) {
    urlAjax = newUrlAjax;
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
function loadListenerActionButtons(callbackUpdate, callbackDelete, callbackVisualizer) {
    document.querySelector('#miTabla').addEventListener('click', async function (e) {
        let urlToUse = url;
        let btn = (e.target.closest('button, a'));
        if (btn && !btn.disabled) {
            if (btn.dataset.abm == "visualizer") {
                urlToUse = urlAjax;
            }
            let ficha = await getFichaOne(btn.dataset.id, urlToUse);
            if (ficha) {
                if (btn.dataset.abm == "update") {
                    $("#modalUpdate form").bootstrapValidator('resetForm', true);
                    $(':input').each(function () {
                        $(this).removeClass('is-valid is-invalid');
                    });
                    callbackUpdate(ficha);
                    $('#modalUpdate').modal('show');
                } else if (btn.dataset.abm == "delete") {
                    callbackDelete(ficha);
                    $('#modalDelete').modal('show');
                } else if (btn.dataset.abm == "visualizer") {
                    callbackVisualizer(ficha);
                }
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