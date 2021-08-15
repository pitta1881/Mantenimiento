import {
    setUrl,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag,
    loadScriptOrdenarPagTablas,
    getFichaAll,
    getPermisosRolActual,
} from '/public/js/generales/jsGeneral.js';

setUrl("/ordendecompra/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'visualize': visualizarOCParticular,
    'update': modificarTipoModal,
    'updateCostoFinal': modificarCostoFinalModal,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);
sessionStorage.clear();

$(function () {
    $('#btnCreateOC').on('click', function () {
        loadTableInsumosUpdateOCNewOC();
        $(this.dataset.target).modal('show');
    })

    $('#modalCheckAndSetCosto').on('show.bs.modal', function (event) {
        let itemsCarrito = JSON.parse(sessionStorage.getItem('insumos'));
        let carritoInner = ``;
        itemsCarrito.forEach(element => {
            carritoInner += `
            <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="m-0">${element.nombre}</p>
                <p class="m-0">${element.cantidad}</p>
            </div>`
        });
        $('#carritoModalCheck').html(carritoInner);
    })
})

//--ORDEN DE COMPRA--\\
async function loadTable() {
    let fichaAll = await getFichaAll();
    let permisosRolActual = await getPermisosRolActual();
    $('#miTabla').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let disabled = ``;
        let btnEye = ``;
        let btnUpdateTipo = ``;
        let btnUpdateCostoFinal = ``;
        (element.usado ? disabled = `disabled` : ``);
        if (permisosRolActual.some(item => item == 49)) {
            btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-abm="visualize" data-id='${element.id}' data-target="#modalGeneral" data-toggle="tooltip" title="Mas Detalles" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
        }
        if (permisosRolActual.some(item => item == 51)) {
            if (element.idEstadoOC != 3 && element.idEstadoOC != 4 && element.idEstadoOC != 5) {
                btnUpdateTipo = ` 
                <button type="button" class="btn btn-outline-primary" data-abm="update" data-id='${element.id}' data-target="#modalTipoUpdate" data-toggle="tooltip" title="Editar Tipo" data-placement="top">
                    <i class="fal fa-pencil fa-lg fa-fw"></i>
                </button>`;
            } else {
                if (element.costoFinal === '-' && element.idEstadoOC != 4) {
                    btnUpdateCostoFinal = ` 
                    <button type="button" class="btn btn-outline-primary" data-abm="updateCostoFinal" data-id='${element.id}' data-target="#modalCostoFinalUpdate" data-toggle="tooltip" title="Editar Costo Final" data-placement="top">
                        <i class="fal fa-money-check-edit-alt fa-lg fa-fw"></i>
                    </button>`;
                }
            }
        }
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.fechaInicio}</td>
            <td>${element.fechaFin}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.tipoNombre}</td>
            <td>$${element.costoEstimado}</td>
            <td>${(element.costoFinal == '-' ? '-' : `$${element.costoFinal}`)}</td>
            <td>${element.nickUsuario}</td>
            <td>${element.cantidadInsumos}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                    ${btnUpdateTipo}
                    ${btnUpdateCostoFinal}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7,8', [9], 'Ordenes de Compra Registrados');
}

function modificarTipoModal(datos) {
    $('#updateOCid').attr('value', datos['id']);
    $('#tipoOCUpdate option[value=' + datos.idTipoOrdenDeCompra + ']').prop('selected', true);
}

function modificarCostoFinalModal(datos) {
    $('#updateCostoFinalOCid').attr('value', datos['id']);
    $('#costoFinal').attr('value', datos['costoEstimado']).val(datos['costoEstimado']);
}

async function loadTableInsumosUpdateOCNewOC() {
    let fichaAll = await getFichaAll('/insumos/');
    $('#tableInsumos').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let carritoItem = ``;
        carritoItem = ` 
            <button type="button" class="btn btn-outline-primary btn-agregar">Agregar
                ${(Number(element.stockReal) < Number(element.stockMinimo) ? `<a class="btn btn-danger btn-badge-insumo-alert" data-toggle="tooltip" title="Stock por debajo del mínimo" data-placement="top"><i class="fal fa-exclamation-circle"></i></a>` : ``)}
            </button>
            <button type="button" class="btn btn-minus-cart btn-md btn-primary border-right-0 border"><i class="fal fa-minus"></i></button>
            <input type="number" data-name="idInsumo" value="${element.id}" hidden>
            <input type="text" data-name="nombre" value="${element.nombre} ${element.descripcion}" hidden>
            <input type="number" data-name="cantidadInsumo" class="input-cart" placeholder="0" value="0" min="0" readonly>
            <button type="button" class="btn btn-plus-cart btn-primary border-left-0 border"><i class="fal fa-plus"></i></button>`;
        textoInner += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.descripcion}</td>
            <td>${element.stockReal}</td>
            <td>${element.stockComprometido}</td>
            <td>${element.stockFuturo}</td>
            <td>${element.medidaNombre}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${(element.stockFuturo == 0 ? carritoItem : `
                    <button type="button" class="btn btn-outline-warning" data-toggle="tooltip" title="Ya está en una OC Abierta" data-placement="top">
                        <i class="fal fa-exclamation-circle fa-lg"></i>
                    </button>
                    `)}
                </div>
            </td>
        </tr>
        `;
    });
    $('#tableInsumos tbody').html(textoInner);
    loadScriptOrdenarPagTablas('tableInsumos', '0,1,2,3,4,5', [6], 'Insumos Registrados', false);
    loadEventosTableInsumosNewOC();
}

function visualizarOCParticular(datos) {
    $('#nav-ordendecompra-tab').click();
    loadDlOrdenDeCompra(datos);
    (datos.idEstadoOC == 3 || datos.idEstadoOC == 4 ? $('#nav-listaInsumosUpd-tab').hide() : (
        $('#nav-listaInsumosUpd-tab').show(),
        loadTableInsumosOC('miTablaListaInsumosUpd', datos)
    ));
}

function loadDlOrdenDeCompra(datos) {
    let textoInner = ``;
    textoInner += `
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Nº OC</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.id}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">F. Inicio</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaInicio}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">F. Fin</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.fechaFin}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Estado</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.estadoNombre}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Tipo</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.tipoNombre}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Costo Est.</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">$${datos.costoEstimado}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Costo Final.</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">$${datos.costoFinal}</dd>
    </div>
    <div class="row m-0">
        <dt class="p-0 col-sm-3 col-lg-2 text-left">Usuario</dt>
        <dd class="p-0 m-0 col-sm-9 col-lg-10 text-left">${datos.nickUsuario}</dd>
    </div>
    <div class="row m-0">
            `;
    document.getElementById('dlOrdenDeCompra').innerHTML = textoInner;
    loadTableInsumosOC('miTablaListaInsumos', datos)
}

function loadTableInsumosOC(table, datos) {
    $('#' + table).DataTable().clear().destroy();
    let textoInner = ``;
    datos.insumos.forEach(insumo => {
        let btnSumar = ``;
        (table === 'miTablaListaInsumos' ? btnSumar = insumo.cantidadRecibida :
            (insumo.idEstado != 1 && insumo.idEstado != 2 ? btnSumar = insumo.cantidadRecibida :
                btnSumar = ` 
            <button type="button" class="btn btn-minus-recibido btn-md btn-primary border-right-0 border" disabled><i class="fal fa-minus"></i></button>
            <input type="number" data-name="idInsumo" value=${insumo.idInsumo} hidden>
            <input type="number" data-name="cantidadInicialInsumo" value=${Number(insumo.cantidadRecibida)} hidden>
            <input type="number" data-name="cantidadInsumo" class="input-recibido" value=${Number(insumo.cantidadRecibida)} min=${Number(insumo.cantidadRecibida)} max=${Number(insumo.cantidadPedida)} readonly>
            <button type="button" class="btn btn-plus-recibido btn-primary border-left-0 border"><i class="fal fa-plus"></i></button>`));
        textoInner += `
        <tr>
            <td>${insumo.nombre}</td>
            <td>${insumo.descripcion}</td>
            <td>${insumo.cantidadPedida}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnSumar}
                </div>
            </td>
            <td>${insumo.estadoNombre}</td>
            ${(table === 'miTablaListaInsumos' ? '': `<td>` +
            (insumo.idEstado == 1 || insumo.idEstado == 2 ? 
                `
                <div class="btn-group btn-group-sm float-none" role="group">
                    <button type="button" class="btn btn-outline-danger btnCancelInsumo" data-target="#modalConfirmCancelInsumo" data-toggle="tooltip" title="Cancelar Cantidad Restante" data-placement="top"
                    data-id-insumo=${insumo.idInsumo}
                    data-id-oc=${datos.id}
                    data-id-estado=${(insumo.cantidadRecibida == 0 ? 4 : 5)}
                    data-cantidadfaltantecancelada=${(insumo.cantidadPedida - insumo.cantidadRecibida)}
                    ><i class="fal fa-trash"></i></button>
                </div>
            `: `-`) + `</td>`
            )}
            
        </tr>
        `
    });
    $('#' + table + ' tbody').html(textoInner);
    $('input#idOCUpdateInsumo').val(datos.id);
    (table === 'miTablaListaInsumos' ? loadScriptOrdenarPagTablas(table, '0,1,2,3', [], 'Insumos Pedidos', true, 'dlOrdenDeCompra') : loadScriptOrdenarPagTablas(table, '0,1,2,3,4', [5], 'Insumos Pedidos', false))
    $('.btnCancelInsumo').on('click', function () {
        $('#formCancelInsumo').bootstrapValidator('resetForm', true);
        let buttonPressed = $(this);
        let idInsumo = buttonPressed.data('id-insumo');
        let idOC = buttonPressed.data('id-oc');
        let idEstado = buttonPressed.data('id-estado');
        let cantidadFaltanteCancelada = buttonPressed.data('cantidadfaltantecancelada');
        let innerForm = `
        <input name="idInsumo" value=${idInsumo} hidden>
        <input name="idOC" value=${idOC} hidden>
        <input name="idEstado" value=${idEstado} hidden>
        <input name="cantidadFaltanteCancelada" value=${cantidadFaltanteCancelada} hidden></input>
        <p> ¿Está seguro que quiere cancelar la cantidad faltante (${cantidadFaltanteCancelada}) del insumo?</p>
        `;
        $('#formCancelInsumo #containerCancelInsumo').html(innerForm);
        $('#modalConfirmCancelInsumo').modal('show');
    });
    loadEventosTableInsumosUpdateOC();
}

function loadEventosTableInsumosUpdateOC() {
    sessionStorage.removeItem('insumosUpdate');

    $(".btn-minus-recibido").on("click", function () {
        let inputCart = $(this).siblings('.input-recibido');
        $(this).siblings('.btn-plus-recibido').attr('disabled', false);
        if (Number(inputCart.val()) > Number(inputCart.attr('min'))) {
            inputCart.val(Number(inputCart.val()) - 1);
            if (inputCart.val() == inputCart.attr('min')) {
                $(this).attr('disabled', true);
            }
        }
        changeLSInsumoUpdate.call(this);
    })

    $(".btn-plus-recibido").on("click", function () {
        let inputCart = $(this).siblings('.input-recibido');
        $(this).siblings('.btn-minus-recibido').attr('disabled', false);
        if (Number(inputCart.val()) < Number(inputCart.attr('max'))) {
            inputCart.val(Number(inputCart.val()) + 1);
            if (inputCart.val() == inputCart.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
        changeLSInsumoUpdate.call(this);
    })

    function changeLSInsumoUpdate() {
        let insumosUpdate = JSON.parse(sessionStorage.getItem('insumosUpdate')) || [];
        let idInsumoElegido = Number($(this).siblings('[data-name=idInsumo]').val());
        let cantidadInicial = Number($(this).siblings('[data-name=cantidadInicialInsumo]').val());
        let cantidadInsumoElegido = Number($(this).siblings('[data-name=cantidadInsumo]').val());
        let insumoToChange = {
            'id': idInsumoElegido,
            'cantidadInicial': cantidadInicial,
            'cantidad': cantidadInsumoElegido,
            'idEstado': (cantidadInsumoElegido == $(this).siblings('[data-name=cantidadInsumo]').attr('max') ? 3 : 2)
        }
        let indexInsumoLocal = insumosUpdate.findIndex(element => element.id == idInsumoElegido);
        if (indexInsumoLocal >= 0) {
            if (cantidadInsumoElegido == Number($(this).siblings('[data-name=cantidadInsumo]').attr('min'))) {
                insumosUpdate.splice(indexInsumoLocal, 1);
            } else {
                insumosUpdate[indexInsumoLocal].cantidad = cantidadInsumoElegido
                if (cantidadInsumoElegido == Number($(this).siblings('[data-name=cantidadInsumo]').attr('max'))) {
                    insumosUpdate[indexInsumoLocal].idEstado = 3
                } else {
                    insumosUpdate[indexInsumoLocal].idEstado = 2
                }
            }
        } else {
            insumosUpdate.push(insumoToChange);
        }
        sessionStorage.setItem('insumosUpdate', JSON.stringify(insumosUpdate));
    }
}

function loadEventosTableInsumosNewOC() {
    $("#tableInsumos .btn-agregar").on("click", function () {
        $(this).toggle();
        $(this).siblings(".btn-minus-cart, .input-cart, .btn-plus-cart").toggle();
        let inputCart = $(this).siblings('.input-cart');
        $('#radioInsumoChk').prop('checked', true).change();
        inputCart.val(1);
        changeLSInsumo.call(this);
    })

    $(".btn-minus-cart").on("click", function () {
        let inputCart = $(this).siblings('.input-cart');
        if (inputCart.val() == 1) {
            $(this).toggle();
            $(this).siblings("#tableInsumos .btn-agregar, .input-cart, .btn-plus-cart").toggle();
        }
        inputCart.val(Number(inputCart.val()) - 1);
        if ($('.input-cart').filter(function () {
                return parseInt($(this).val(), 10) > 0;
            }).length == 0) {
            $('#radioInsumoChk').prop('checked', false).change();
        }
        changeLSInsumo.call(this);
    })

    $(".btn-plus-cart").on("click", function () {
        let inputCart = $(this).siblings('.input-cart');
        inputCart.val(Number(inputCart.val()) + 1);
        changeLSInsumo.call(this);
    })

    function changeLSInsumo() {
        let insumos = JSON.parse(sessionStorage.getItem('insumos')) || [];
        let idInsumoElegido = $(this).siblings('[data-name=idInsumo]').val();
        let nombreInsumoElegido = $(this).siblings('[data-name=nombre]').val();
        let cantidadInsumoElegido = $(this).siblings('[data-name=cantidadInsumo]').val();
        let insumoToChange = {
            'id': idInsumoElegido,
            'nombre': nombreInsumoElegido,
            'cantidad': cantidadInsumoElegido
        }
        let indexInsumoLocal = insumos.findIndex(element => element.id == idInsumoElegido);
        if (indexInsumoLocal >= 0) {
            if (cantidadInsumoElegido == 0) {
                insumos.splice(indexInsumoLocal, 1);
            } else {
                insumos[indexInsumoLocal].cantidad = cantidadInsumoElegido
            }
        } else {
            insumos.push(insumoToChange);
        }
        sessionStorage.setItem('insumos', JSON.stringify(insumos));
    }
}