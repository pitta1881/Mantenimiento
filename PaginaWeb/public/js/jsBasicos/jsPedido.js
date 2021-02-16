import {
    setUrl,
    setUrlAjax,
    modificarModalPedido as modificarModal,
    deleteModalPedido as deleteModal,
    visualizarSectorPedido,
    visualizarPedidoGeneral,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadScriptOrdenarPagTablas,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/pedidos/");
setUrlAjax("/administracion/sectores/");

loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize': visualizarPedidoGeneral,
    'visualize-2': visualizarSectorPedido
});
loadScriptValidarCampos();
loadScriptOrdenarPagTablas('miTabla', '0,1,2,3,4,5,6,7,8', [9], 'Pedidos Registrados', false);