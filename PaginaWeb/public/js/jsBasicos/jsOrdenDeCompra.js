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
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);
localStorage.clear();

$(function () {
    $('#btnCreateOC').on('click', function () {
        visualizarInsumosModal();
        $(this.dataset.target).modal('show');
    })

    $('#modalCheckAndSetCosto').on('show.bs.modal', function (event) {
        let itemsCarrito = JSON.parse(localStorage.getItem('insumos'));
        let carritoInner = ``;
        itemsCarrito.forEach(element => {
            carritoInner += `<p class="text-left border-bottom">${element.nombre} - ${element.cantidad}</p>`
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
        (element.usado ? disabled = `disabled` : ``);
        if (permisosRolActual.some(item => item == 49)) {
            btnEye = ` 
            <button type="button" class="btn btn-outline-primary" data-abm="visualize-2" data-id='${element.id}' data-toggle="tooltip" title="Mas Detalles" data-placement="top">
                <i class="fal fa-eye fa-lg fa-fw"></i>
            </button>`;
        }
        textoInner += `
        <tr>
            <td>${element.id}</td>
            <td>${element.fecha}</td>
            <td>${element.estadoNombre}</td>
            <td>${element.tipoNombre}</td>
            <td>$${element.costoEstimado}</td>
            <td>${element.nickUsuario}</td>
            <td>${element.cantidadInsumos}</td>
            <td>
                <div class="btn-group btn-group-sm float-none" role="group">
                    ${btnEye}
                </div>
            </td>
        </tr>
        `;
    });
    $('#miTabla tbody').html(textoInner);
    loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6', [7], 'Ordenes de Compra Registrados');
}

async function visualizarInsumosModal() {
    let fichaAll = await getFichaAll('/insumos/');
    $('#tableInsumos').DataTable().clear().destroy();
    let textoInner = ``;
    fichaAll.forEach(element => {
        let carritoItem = ``;
        carritoItem = ` 
            <button type="button" class="btn btn-outline-primary btn-agregar" data-toggle="tooltip" title="Agregar Insumo" data-placement="top">Agregar</button>
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
                    ${carritoItem}
                </div>
            </td>
        </tr>
        `;
    });
    $('#tableInsumos tbody').html(textoInner);
    loadScriptOrdenarPagTablas('tableInsumos', '0,1,2,3,4,5', [6], 'Insumos Registrados', false);
    loadEventosTableInsumo();
}

function loadEventosTableInsumo() {
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
        let insumos = JSON.parse(localStorage.getItem('insumos')) || [];
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
        localStorage.setItem('insumos', JSON.stringify(insumos));
    }
}