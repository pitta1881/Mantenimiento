import {
    setUrl,
    setUrlAjax,
    setUrlAjax2,
    loadTablePedido as loadTable,
    modificarModalPedido as modificarModal,
    deleteModalPedido as deleteModal,
    visualizarPersonaAgente,
    visualizarSectorPedido,
    visualizarPedidoGeneral,
    loadListenerActionButtons,
    loadScriptValidarCampos,
    loadTooltips,
    modalDrag
} from '/public/js/generales/jsGeneral.js';

setUrl("/pedidos/");
setUrlAjax("/administracion/sectores/");
setUrlAjax2("/administracion/personas/");

loadTable();
loadTooltips();
modalDrag();
loadListenerActionButtons({
    'update': modificarModal,
    'delete': deleteModal,
    'visualize': visualizarPedidoGeneral,
    'visualize-2': visualizarSectorPedido,
    'visualize-3': visualizarPersonaAgente,
    'loadTable': loadTable
});
loadScriptValidarCampos(loadTable);